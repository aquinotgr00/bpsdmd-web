<?php

namespace App\Services\Domain;

use App\Entities\Organization;
use App\Entities\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * Paginate disease
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateUser($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('u')
        ->where('u.isActive = :isActive')->andWhere('u.isDelete = :isDelete')
        ->setParameters([
            'isActive'  => 1,
            'isDelete'  => 0
        ])->getQuery();

        return $this->paginate($query, $limit, $page, false);
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
        $user->setName($data->get('name'));

        if (!empty($data->get('uploaded_img'))) {
            $user->setPhoto($data->get('uploaded_img'));            
        }
        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        EntityManager::persist($user);

        if ($flush) {
            EntityManager::flush();

            return $user;
        }
    }

    /**
     * Update user
     *
     * @param User $user
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return User
     */

    public function update(User $user, Collection $data, $org = false, $flush = true)
    {
        $user->setUsername($data->get('username'));
        $user->setName($data->get('name'));
        $user->setAuthority($data->get('authority'));
        $user->setIsActive($data->get('isactive'));
        
        if (!is_null($data->get('password'))) {
            $user->setPassword($data->get('password'));

        }
        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        if (!empty($data->get('uploaded_img'))) {
            $user->setPhoto($data->get('uploaded_img'));            
        }

        EntityManager::persist($user);

        if ($flush) {
            EntityManager::flush();
            return $user;
        }
    }

    /**
     * Update User Profile
     *
     * @param User $user
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return User
     */

    public function updateProfile(User $user, Collection $data, $org = false, $flush = true)
    {
        $user->setUsername($data->get('username'));
        $user->setName($data->get('name'));
        $user->setPassword($data->get('password'));

        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        if (!empty($data->get('uploaded_img'))) {
            $user->setPhoto($data->get('uploaded_img'));            
        }


        EntityManager::persist($user);

        if ($flush) {
            EntityManager::flush();
            return $user;
        }
    }

    /**
     * Delete organization
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        $user->setIsActive(0);
        $user->setIsDelete(1);
        EntityManager::persist($user);
        if (EntityManager::flush()) {
            return true;
        }            
        return false;
    }
}
