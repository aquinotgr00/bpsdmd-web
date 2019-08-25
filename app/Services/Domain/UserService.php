<?php

namespace App\Services\Domain;

use App\Entities\Organization;
use App\Entities\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
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
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(User::class);
    }

    /**
     * Create new user
     *
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return User
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $user = new User;
        $user->setUsername($data->get('username'));
        $user->setPassword($data->get('password'));
        $user->setAuthority($data->get('authority'));

        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        EntityManager::persist($user);

        if ($flush) {
            EntityManager::flush();

            return $user;
        }
    }
}
