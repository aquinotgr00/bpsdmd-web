<?php

namespace App\Services\Domain;

use App\Entities\ShortCourse;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class ShortCourseService
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
            ->from(ShortCourse::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(ShortCourse::class);
    }

    /**
     * Get count short course
     *
     * @return int
     */
    public function getCountShortCourse()
    {
        try {
            $qb = $this->createQueryBuilder('sc');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
