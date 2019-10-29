<?php

namespace App\Services\Domain;

use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class StudentService
{
    use PaginatesFromParams;

    /**
     * @param $alias
     * @param null $indexBy
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return EntityManager::createQueryBuilder()
            ->select($alias)
            ->from(Student::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Student::class);
    }

    /**
     * Get count student
     *
     * @return int
     */
    public function getCountStudent()
    {
        try {
            $qb = $this->createQueryBuilder('s')
                ->select('count(s.id)');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate student
     *
     * @param $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateStudent($page, Organization $org): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('s')
            ->andWhere('s.org = :orgId')
            ->orderBy('s.id')
            ->setParameter('orgId', $org->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Paginate Recruitment
     *
     * @param $page\
     * @return LengthAwarePaginator
     */
    public function paginateRecruitment($page, Collection $search): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('s');
        if(!empty($search->get('ipk'))){
            $query->where('s.ipk = :ipk')->setParameter('ipk', $search->get('ipk'));
        }
        if(!empty($search->get('gender'))){
            $query->where('s.gender = :gender')->setParameter('gender', $search->get('gender'));
        }
        if(!empty($search->get('age')) || !empty($search->get('agemax'))){
            $from = Carbon::today()->subYears($search->get('age'));
            $to = Carbon::today()->subYears($search->get('agemax'));
            $query->where("s.dateOfBirth in (:age)")->setParameter('age', [$to, $from]);
        }

        $query = $query->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Student
     *
     * @param Collection $data
     * @param bool $flush
     * @return Student
     */
    public function create(Collection $data, $org = false, $studyProgram = false, $flush = true)
    {
        $student = new Student;
        $student->setCode($data->get('code'));
        $student->setName($data->get('name'));
        $student->setPeriod($data->get('period'));
        $student->setCurriculum($data->get('curriculum'));
        $student->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $student->setClass($data->get('class'));
        $student->setIpk($data->get('ipk'));
        $student->setIdentityNumber($data->get('identity_number'));
        $student->setGender($data->get('gender'));
        $student->setStatus($data->get('status'));
        $student->setGraduationYear($data->get('graduationYear'));

        if ($org instanceof Organization) {
            $student->setOrg($org);
        }
        if ($studyProgram instanceof StudyProgram) {
            $student->setStudyProgram($studyProgram);
        }

        if ($data->get('uploaded_img')) {
            $student->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($student);

        if ($flush) {
            EntityManager::flush();

            return $student;
        }
    }

    /**
     * Update Student
     *
     * @param Student $student
     * @param Collection $data
     * @param bool $flush
     * @return Student
     */
    public function update(Student $student, Collection $data, $org = false, $studyProgram = false, $flush = true)
    {
        $student->setCode($data->get('code'));
        $student->setName($data->get('name'));
        $student->setPeriod($data->get('period'));
        $student->setCurriculum($data->get('curriculum'));
        $student->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $student->setClass($data->get('class'));
        $student->setIpk($data->get('ipk'));
        $student->setIdentityNumber($data->get('identity_number'));
        $student->setGender($data->get('gender'));
        $student->setStatus($data->get('status'));
        $student->setGraduationYear($data->get('graduationYear'));

        if ($org instanceof Organization) {
            $student->setOrg($org);
        }

        if ($studyProgram instanceof StudyProgram) {
            $student->setStudyProgram($studyProgram);
        }

        if ($data->get('uploaded_img')) {
            @unlink(public_path(Student::UPLOAD_PATH).'/'.$student->getPhoto());
            $student->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($student);

        if ($flush) {
            EntityManager::flush();

            return $student;
        }
    }

    /**
     * Delete Student
     *
     * @param Student $student
     * @return bool
     * @throws StudentDeleteException
     */
    public function delete(Student $student)
    {
        EntityManager::remove($student);
        EntityManager::flush();
    }

    /**
     * Find Student by id
     *
     * @param $id
     * @return Student
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
