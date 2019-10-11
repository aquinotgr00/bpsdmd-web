<?php

namespace App\Services\Domain;

use App\Entities\ShortCourseData;
use App\Entities\ShortCourse;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class ShortCourseDataService
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
            ->from(ShortCourseData::class, $alias, $indexBy);
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
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(ShortCourseData::class);
    }

    /**
     * Paginate ShortCourseData
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateShortCourseData($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('scd')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new ShortCourseData
     *
     * @param Collection $data
     * @param bool $flush
     * @return ShortCourseData
     */
    public function create(Collection $data, $shortCourse = false, $flush = true)
    {
        $shortCourseData = new ShortCourseData;
        $shortCourseData->setStartDate(date_create_from_format('d-m-Y', $data->get('startDate')));
        $shortCourseData->setEndDate(date_create_from_format('d-m-Y', $data->get('endDate')));
        $shortCourseData->setTotalTarget($data->get('totalTarget'));
        $shortCourseData->setTotalRealization($data->get('totalRealization'));
        $shortCourseData->setOpenSk($data->get('openSk'));
        $shortCourseData->setCloseSk($data->get('closeSk'));
        $shortCourseData->setGeneration($data->get('generation'));
        $shortCourseData->setYear($data->get('year'));
        $shortCourseData->setShortCourseTime($data->get('shortCourseTime'));
        $shortCourseData->setPlace($data->get('place'));

        if ($shortCourse instanceof ShortCourse) {
            $shortCourseData->setShortCourse($shortCourse);
        }

        EntityManager::persist($shortCourseData);

        if ($flush) {
            EntityManager::flush();

            return $shortCourseData;
        }
    }

    /**
     * Update ShortCourseData
     *
     * @param ShortCourseData $shortCourseData
     * @param Collection $data
     * @param bool $flush
     * @return ShortCourseData
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(ShortCourseData $shortCourseData, Collection $data, $shortCourse = false, $flush = true)
    {
        $shortCourseData->setStartDate(date_create_from_format('d-m-Y', $data->get('startDate')));
        $shortCourseData->setEndDate(date_create_from_format('d-m-Y', $data->get('endDate')));
        $shortCourseData->setTotalTarget($data->get('totalTarget'));
        $shortCourseData->setTotalRealization($data->get('totalRealization'));
        $shortCourseData->setOpenSk($data->get('openSk'));
        $shortCourseData->setCloseSk($data->get('closeSk'));
        $shortCourseData->setGeneration($data->get('generation'));
        $shortCourseData->setYear($data->get('year'));
        $shortCourseData->setShortCourseTime($data->get('shortCourseTime'));
        $shortCourseData->setPlace($data->get('place'));

        if ($shortCourse instanceof ShortCourse) {
            $shortCourseData->setShortCourse($shortCourse);
        }

        EntityManager::persist($shortCourseData);

        if ($flush) {
            EntityManager::flush();

            return $shortCourseData;
        }
    }

    /**
     * Delete ShortCourseData
     *
     * @param ShortCourseData $shortCourseData
     * @return bool
     * @throws ShortCourseDataDeleteException
     */
    public function delete(ShortCourseData $shortCourseData)
    {
        EntityManager::remove($shortCourseData);
        EntityManager::flush();
    }

    /**
     * Find ShortCourseData by id
     *
     * @param $id
     * @return ShortCourseData
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
