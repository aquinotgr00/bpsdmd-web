<?php

namespace App\Services\Domain;

use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
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
            $qb = $this->createQueryBuilder('s');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate disease
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateStudent($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('s')
            ->getQuery();

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
        $student->setStatus($data->get('status'));
        $student->setGraduationYear($data->get('graduationYear'));

        if ($org instanceof Organization) {
            $student->setOrg($org);
        }
        if ($studyProgram instanceof StudyProgram) {
            $student->setStudyProgram($studyProgram);
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
        $student->setStatus($data->get('status'));
        $student->setGraduationYear($data->get('graduationYear'));

        if ($org instanceof Organization) {
            $student->setOrg($org);
        }
        if ($studyProgram instanceof StudyProgram) {
            $student->setStudyProgram($studyProgram);
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
