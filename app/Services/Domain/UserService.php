<?php

namespace App\Services\Domain;

use App\Entities\User;
use App\Interfaces\UserInterface;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class UserService
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
            ->from(User::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(User::class);
    }
}
