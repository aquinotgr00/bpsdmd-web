<?php

namespace App\Services\Domain;

use App\Entities\Student;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
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
}
