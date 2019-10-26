<?php

namespace App\Services\Domain;

use App\Entities\ShortCourse;
use App\Entities\Organization;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
     * @param $dql
     * @return \Doctrine\ORM\Query
     */
    public function createQuery($dql)
    {
        return EntityManager::createQuery($dql);
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
     * Paginate ShortCourse
     *
     * @param $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateShortCourse($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('sc')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new ShortCourse
     *
     * @param Collection $data
     * @param bool $flush
     * @return ShortCourse
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $shortCourse = new ShortCourse;
        $shortCourse->setName($data->get('name'));
        $shortCourse->setType($data->get('type'));

        if ($org instanceof Organization) {
            $shortCourse->setOrg($org);
        }

        EntityManager::persist($shortCourse);

        if ($flush) {
            EntityManager::flush();

            return $shortCourse;
        }
    }

    /**
     * Update ShortCourse
     *
     * @param ShortCourse $shortCourse
     * @param Collection $data
     * @param bool $flush
     * @return ShortCourse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(ShortCourse $shortCourse, Collection $data, $org = false, $flush = true)
    {
        $shortCourse->setName($data->get('name'));
        $shortCourse->setType($data->get('type'));

        if ($org instanceof Organization) {
            $shortCourse->setOrg($org);
        }

        EntityManager::persist($shortCourse);

        if ($flush) {
            EntityManager::flush();

            return $shortCourse;
        }
    }

    /**
     * Delete ShortCourse
     *
     * @param ShortCourse $shortCourse
     */
    public function delete(ShortCourse $shortCourse)
    {
        EntityManager::remove($shortCourse);
        EntityManager::flush();
    }

    /**
     * Find ShortCourse by id
     *
     * @param $id
     * @return ShortCourse
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Get short course by type
     *
     * @param string $type
     * @return ShortCourse[]
     */
    public function getShortCourseByType($type = 'all')
    {
        if ($type == ShortCourse::TYPE_DPM) {
            return $this->getRepository()->findBy(['type' => ShortCourse::TYPE_DPM]);
        } elseif ($type == ShortCourse::TYPE_TEKNIS) {
            return $this->getRepository()->findBy(['type' => ShortCourse::TYPE_TEKNIS]);
        }

        return $this->getRepository()->findAll();
    }
}
