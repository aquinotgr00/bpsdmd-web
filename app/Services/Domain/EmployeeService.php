<?php

namespace App\Services\Domain;

use App\Entities\Employee;
use App\Entities\Organization;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class EmployeeService
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
            ->from(Employee::class, $alias, $indexBy);
    }

    /**
     * @return Employee[]
     */
    public function findByName(string $name)
    {
        $query = $this->createQueryBuilder('s')
            ->where('LOWER(s.name) LIKE :name')
            ->orderBy('s.name', 'asc')
            ->setParameter('name', "%{$name}%")
            ->getQuery()
            ->getArrayResult();

        return $query;
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Employee::class);
    }

    /**
     * Get count Employee
     *
     * @return int
     */
    public function getCountEmployee()
    {
        try {
            $qb = $this->createQueryBuilder('e');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate employee
     *
     * @param $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateEmployee($page, Organization $org): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('e')
            ->andWhere('e.org = :orgId')
            ->orderBy('e.id')
            ->setParameter('orgId', $org->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Employee
     *
     * @param Collection $data
     * @param bool $flush
     * @return Employee
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $employee = new Employee;
        $employee->setCode($data->get('code'));
        $employee->setName($data->get('name'));
        $employee->setEmail($data->get('email'));
        $employee->setIdentityNumber($data->get('identity_number'));
        $employee->setGender($data->get('gender'));
        $employee->setPlaceOfBirth($data->get('place_of_birth'));
        $employee->setLanguage($data->get('language'));
        $employee->setNationality($data->get('nationality'));
        $employee->setDegree($data->get('degree'));
        $employee->setEducationLevel($data->get('education_level'));
        $employee->setLocation($data->get('location'));
        $employee->setDuration($data->get('duration'));
        $employee->setMajor($data->get('major'));
        $employee->setEmail($data->get('email'));
        $employee->setPhoneNumber($data->get('phone_number'));

        if ($data->get('dateOfBirth')) {
            $employee->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        }
        if ($org instanceof Organization) {
            $employee->setOrg($org);
        }

        if ($data->get('uploaded_img')) {
            $employee->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($employee);

        if ($flush) {
            EntityManager::flush();

            return $employee;
        }
    }

    /**
     * Update Employee
     *
     * @param Employee $employee
     * @param Collection $data
     * @param bool $flush
     * @return Employee
     */
    public function update(Employee $employee, Collection $data, $org = false, $flush = true)
    {
        $employee->setCode($data->get('code'));
        $employee->setName($data->get('name'));
        $employee->setEmail($data->get('email'));
        $employee->setIdentityNumber($data->get('identity_number'));
        $employee->setGender($data->get('gender'));
        $employee->setPlaceOfBirth($data->get('place_of_birth'));
        $employee->setLanguage($data->get('language'));
        $employee->setNationality($data->get('nationality'));
        $employee->setDegree($data->get('degree'));
        $employee->setEducationLevel($data->get('education_level'));
        $employee->setLocation($data->get('location'));
        $employee->setDuration($data->get('duration'));
        $employee->setMajor($data->get('major'));
        $employee->setEmail($data->get('email'));
        $employee->setPhoneNumber($data->get('phone_number'));

        if ($data->get('dateOfBirth')) {
            $employee->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        }
        if ($org instanceof Organization) {
            $employee->setOrg($org);
        }

        if ($data->get('uploaded_img')) {
            @unlink(public_path(Employee::UPLOAD_PATH).'/'.$employee->getPhoto());
            $employee->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($employee);

        if ($flush) {
            EntityManager::flush();

            return $employee;
        }
    }

    /**
     * Delete Employee
     *
     * @param Employee $employee
     * @return bool
     * @throws EmployeeDeleteException
     */
    public function delete(Employee $employee)
    {
        if ($employee->getPhoto()) {
            @unlink(public_path(Employee::UPLOAD_PATH).'/'.$employee->getPhoto());
        }

        EntityManager::remove($employee);
        EntityManager::flush();
    }

    /**
     * Find Employee by id
     *
     * @param $id
     * @return Employee
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
