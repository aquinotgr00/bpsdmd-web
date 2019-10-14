<?php

namespace App\Services\Domain;

use App\Entities\Employee;
use App\Entities\Certificate;
use App\Entities\EmployeeCertificate;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class EmployeeCertificateService
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
            ->from(EmployeeCertificate::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(EmployeeCertificate::class);
    }

    /**
     * Get count EmployeeCertificate
     *
     * @return int
     */
    public function getCountEmployeeCertificate()
    {
        try {
            $qb = $this->createQueryBuilder('ec');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate EmployeeCertificate
     *
     * @param $page
     * @param Employee $employee
     * @return LengthAwarePaginator
     */
    public function paginateEmployeeCertificate($page, Employee $employee): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('ec')
            ->andWhere('ec.employee = :employeeId')
            ->orderBy('ec.id')
            ->setParameter('employeeId', $employee->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new EmployeeCertificate
     *
     * @param Collection $data
     * @param bool $flush
     * @return EmployeeCertificate
     */
    public function create(Collection $data, $employee = false, $certificate = false, $flush = true)
    {
        $employeecertificate = new EmployeeCertificate;
        $employeecertificate->setValidityPeriod(date_create_from_format('d-m-Y', $data->get('validityPeriod')));

        if ($employee instanceof Employee) {
            $employeecertificate->setEmployee($employee);
        }
        if ($certificate instanceof Certificate) {
            $employeecertificate->setCertificate($certificate);
        }

        EntityManager::persist($employeecertificate);

        if ($flush) {
            EntityManager::flush();

            return $employeecertificate;
        }
    }

    /**
     * Update EmployeeCertificate
     *
     * @param EmployeeCertificate $employee
     * @param Collection $data
     * @param bool $flush
     * @return EmployeeCertificate
     */
    public function update(EmployeeCertificate $employeecertificate, Collection $data, $employee = false, $certificate = false, $flush = true)
    {
        $employeecertificate->setValidityPeriod(date_create_from_format('d-m-Y', $data->get('validityPeriod')));

        if ($employee instanceof Employee) {
            $employeecertificate->setEmployee($employee);
        }
        if ($certificate instanceof Certificate) {
            $employeecertificate->setCertificate($certificate);
        }

        EntityManager::persist($employeecertificate);

        if ($flush) {
            EntityManager::flush();

            return $employeecertificate;
        }
    }

    /**
     * Delete EmployeeCertificate
     *
     * @param EmployeeCertificate $employeecertificate
     * @return bool
     * @throws EmployeeDeleteException
     */
    public function delete(EmployeeCertificate $employeecertificate)
    {
        EntityManager::remove($employeecertificate);
        EntityManager::flush();
    }

    /**
     * Find EmployeeCertificate by id
     *
     * @param $id
     * @return EmployeeCertificate
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
