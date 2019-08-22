<?php

namespace App\Services\Domain;

use App\Entities\Test;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class TestService
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
            ->from(Test::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Test::class);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->getRepository()->findAll();
    }
}
