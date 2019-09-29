<?php

namespace App\Services\Domain;

use App;
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
            ->andWhere('u.isDeleted = :isDeleted')
            ->orderBy('u.id')
            ->setParameter('isDeleted', 0)
            ->getQuery();

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
        $user->setEmail($data->get('username'));
        $user->setPassword($data->get('password'));
        $user->setAuthority($data->get('authority'));
        $user->setName($data->get('name'));
        $user->setEmail($data->get('email'));

        if (!$data->get('isActive')) {
            if ($data->get('authority') != User::ROLE_ADMIN) {
                $user->setIsActive(0);
            } else {
                $user->setIsActive(1);
            }
        } else {
            $user->setIsActive($data->get('isActive'));
        }

        if ($data->get('uploaded_img')) {
            $user->setPhoto($data->get('uploaded_img'));
        }

        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        if ($data->get('language')) {
            $user->setLocale($data->get('language'));
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
        $user->setEmail($data->get('email'));
        $user->setName($data->get('name'));
        $user->setIsActive($data->get('active'));

        if (!is_null($data->get('password'))) {
            $user->setPassword($data->get('password'));
        }

        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        if ($data->get('uploaded_img')) {
            @unlink(public_path(User::UPLOAD_PATH).'/'.$user->getPhoto());
            $user->setPhoto($data->get('uploaded_img'));
        }

        $user->setLocale($data->get('language'));

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
        $user->setEmail($data->get('email'));
        $user->setName($data->get('name'));

        if ($data->get('password')) {
            $user->setPassword($data->get('password'));
        }

        if ($org instanceof Organization) {
            $user->setOrg($org);
        }

        if (!empty($data->get('uploaded_img'))) {
            $user->setPhoto($data->get('uploaded_img'));
        }

        $user->setLocale($data->get('language'));

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
        $user->setIsDeleted(1);

        EntityManager::persist($user);
        EntityManager::flush();
    }

    /**
     * Check if email exist
     *
     * @param $email
     * @param bool $id
     * @return bool
     */
    public function checkEmailExist($email, $id = false)
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->andWhere('u.isDeleted = :deleted')
            ->setParameter('deleted', 0);

        if ($id) {
            $qb->AndWhere('u.id != :id')
                ->setParameter('id', $id);
        }

        try {
            $user = $qb->getQuery()->getSingleResult();

            if ($user instanceof User) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    /**
     * Enable User
     *
     * @param User $user
     */
    public function enableUser(User $user)
    {
        $user->setIsActive(1);

        EntityManager::persist($user);
        EntityManager::flush();
    }

    /**
     * Disable User
     *
     * @param User $user
     */
    public function disableUser(User $user)
    {
        $user->setIsActive(0);

        EntityManager::persist($user);
        EntityManager::flush();
    }
}
