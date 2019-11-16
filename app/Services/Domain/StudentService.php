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
    public function paginateRecruitment($page, Collection $search, $studyProgram = false): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('s')->leftJoin('s.org', 'o');
        if($studyProgram instanceof StudyProgram){
            $query->andWhere('s.studyProgram = :studyProgramId')->setParameter('studyProgramId', $studyProgram->getId());
        }
        if(!empty($search->get('ipk'))){
            $query->andWhere('s.ipk = :ipk')->setParameter('ipk', $search->get('ipk'));
        }
        if(!empty($search->get('gender'))){
            $query->andWhere('s.gender = :gender')->setParameter('gender', $search->get('gender'));
        }
        if(!empty($search->get('age')) || !empty($search->get('agemax'))){
            $minDate = Carbon::today()->subYears($search->get('agemax'));
            $maxDate = Carbon::today()->subYears($search->get('age'))->endOfDay();
            $query->andWhere("s.dateOfBirth BETWEEN :minDate AND :maxDate")->setParameter('minDate', $minDate)->setParameter('maxDate', $maxDate);
        }
        if(!empty($search->get('accreditation'))){
            $query->andWhere('o.accreditation = :accreditation')->setParameter('accreditation', $search->get('accreditation'));
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
        $student->setIdDikti($data->get('id_dikti'));
        $student->setNim($data->get('nim'));
        $student->setName($data->get('name'));
        $student->setGender($data->get('gender'));
        $student->setPlaceOfBirth($data->get('place_of_birth'));
        $student->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $student->setAddress($data->get('address'));
        $student->setPhoneNumber($data->get('phone_number'));
        $student->setMobilePhoneNumber($data->get('mobile_phone_number'));
        $student->setEmail($data->get('email'));
        $student->setReligion($data->get('religion'));
        $student->setMotherName($data->get('mother_name'));
        $student->setNationality($data->get('nationality'));
        $student->setForeignCitizen($data->get('foreign_citizen'));
        $student->setSocialProtectionCard($data->get('social_protection_card'));
        $student->setOccupationType($data->get('occupation_type'));
        $student->setIdentityNumber($data->get('identity_number'));
        $student->setStartSemester($data->get('start_semester'));
        $student->setCurrentSemester($data->get('current_semester'));
        $student->setStudentCredits($data->get('student_credits'));
        $student->setIpk($data->get('ipk'));
        $student->setCertificateNumber($data->get('certificate_number'));
        $student->setEnrollmentType($data->get('enrollment_type'));
        $student->setGraduationType($data->get('graduation_type'));
        $student->setPeriod($data->get('period'));
        $student->setCurriculum($data->get('curriculum'));
        $student->setClass($data->get('class'));
        $student->setStatus($data->get('status'));
        $student->setGraduationYear($data->get('graduationYear'));
        $student->setLastUpdate(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('enrollment_date_start')) {
            $student->setEnrollmentDateStart(date_create_from_format('d-m-Y', $data->get('enrollment_date_start')));
        }
        if ($data->get('enrollment_date_end')) {
            $student->setEnrollmentDateEnd(date_create_from_format('d-m-Y', $data->get('enrollment_date_end')));
        }
        if ($data->get('graduation_judgement_date')) {
            $student->setGraduationJudgementDate(date_create_from_format('d-m-Y', $data->get('graduation_judgement_date')));
        }
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
        $student->setIdDikti($data->get('id_dikti'));
        $student->setNim($data->get('nim'));
        $student->setName($data->get('name'));
        $student->setGender($data->get('gender'));
        $student->setPlaceOfBirth($data->get('place_of_birth'));
        $student->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $student->setAddress($data->get('address'));
        $student->setPhoneNumber($data->get('phone_number'));
        $student->setMobilePhoneNumber($data->get('mobile_phone_number'));
        $student->setEmail($data->get('email'));
        $student->setReligion($data->get('religion'));
        $student->setMotherName($data->get('mother_name'));
        $student->setNationality($data->get('nationality'));
        $student->setForeignCitizen($data->get('foreign_citizen'));
        $student->setSocialProtectionCard($data->get('social_protection_card'));
        $student->setOccupationType($data->get('occupation_type'));
        $student->setIdentityNumber($data->get('identity_number'));
        $student->setStartSemester($data->get('start_semester'));
        $student->setCurrentSemester($data->get('current_semester'));
        $student->setStudentCredits($data->get('student_credits'));
        $student->setIpk($data->get('ipk'));
        $student->setCertificateNumber($data->get('certificate_number'));
        $student->setEnrollmentType($data->get('enrollment_type'));
        $student->setGraduationType($data->get('graduation_type'));
        $student->setPeriod($data->get('period'));
        $student->setCurriculum($data->get('curriculum'));
        $student->setClass($data->get('class'));
        $student->setStatus($data->get('status'));
        $student->setGraduationYear($data->get('graduationYear'));
        $student->setLastUpdate(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('enrollment_date_start')) {
            $student->setEnrollmentDateStart(date_create_from_format('d-m-Y', $data->get('enrollment_date_start')));
        }
        if ($data->get('enrollment_date_end')) {
            $student->setEnrollmentDateEnd(date_create_from_format('d-m-Y', $data->get('enrollment_date_end')));
        }
        if ($data->get('graduation_judgement_date')) {
            $student->setGraduationJudgementDate(date_create_from_format('d-m-Y', $data->get('graduation_judgement_date')));
        }
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
        if ($student->getPhoto()) {
            @unlink(public_path(Student::UPLOAD_PATH).'/'.$student->getPhoto());
        }

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
