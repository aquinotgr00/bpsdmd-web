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
    public function create(Collection $data, $org = false, $school = false, $flush = true)
    {
        $employee = new Employee;
        $employee->setCode($data->get('code'));
        $employee->setName($data->get('name'));
        $employee->setIdentityNumber($data->get('identity_number'));
        $employee->setGender($data->get('gender'));
        $employee->setPlaceOfBirth($data->get('placeOfBirth'));
        $employee->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $employee->setLanguage($data->get('language'));
        $employee->setNationality($data->get('nationality'));

        if ($org instanceof Organization) {
            $employee->setOrg($org);
        }
        if ($school instanceof Organization) {
            $employee->setSchool($school);
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
    public function update(Employee $employee, Collection $data, $org = false, $school = false, $flush = true)
    {
        $employee->setCode($data->get('code'));
        $employee->setName($data->get('name'));
        $employee->setIdentityNumber($data->get('identity_number'));
        $employee->setGender($data->get('gender'));
        $employee->setPlaceOfBirth($data->get('placeOfBirth'));
        $employee->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $employee->setLanguage($data->get('language'));
        $employee->setNationality($data->get('nationality'));

        if ($org instanceof Organization) {
            $employee->setOrg($org);
        }
        if ($school instanceof Organization) {
            $employee->setSchool($school);
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
