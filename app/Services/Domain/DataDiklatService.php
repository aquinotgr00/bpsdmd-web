<?php

namespace App\Services\Domain;

use App\Entities\DataDiklat;
use App\Entities\Diklat;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class DataDiklatService
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
            ->from(DataDiklat::class, $alias, $indexBy);
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
        return EntityManager::getRepository(DataDiklat::class);
    }

    /**
     * Paginate DataDiklat
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateDataDiklat($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('d')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new DataDiklat
     *
     * @param Collection $data
     * @param bool $flush
     * @return DataDiklat
     */
    public function create(Collection $data, $flush = true)
    {
        $dataDiklat = new DataDiklat;
        $dataDiklat->setStartDate(date_create_from_format('d-m-Y', $data->get('startDate')));
        $dataDiklat->setEndDate(date_create_from_format('d-m-Y', $data->get('endDate')));
        $dataDiklat->setTotalTarget($data->get('totalTarget'));
        $dataDiklat->setTotalRealization($data->get('totalRealization'));
        $dataDiklat->setRequirement($data->get('requirement'));
        $dataDiklat->setTarget($data->get('target'));
        $dataDiklat->setOutputDiklat($data->get('outputDiklat'));
        $dataDiklat->setOutcomeDiklat($data->get('outcomeDiklat'));

        if ($data->get('diklat') instanceof Diklat) {
            $dataDiklat->setDiklat($data->get('diklat'));
        }

        EntityManager::persist($dataDiklat);

        if ($flush) {
            EntityManager::flush();

            return $dataDiklat;
        }
    }

    /**
     * Update DataDiklat
     *
     * @param DataDiklat $dataDiklat
     * @param Collection $data
     * @param bool $flush
     * @return DataDiklat
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(DataDiklat $dataDiklat, Collection $data, $flush = true)
    {
        $dataDiklat->setStartDate(date_create_from_format('d-m-Y', $data->get('startDate')));
        $dataDiklat->setEndDate(date_create_from_format('d-m-Y', $data->get('endDate')));
        $dataDiklat->setTotalTarget($data->get('totalTarget'));
        $dataDiklat->setTotalRealization($data->get('totalRealization'));
        $dataDiklat->setRequirement($data->get('requirement'));
        $dataDiklat->setTarget($data->get('target'));
        $dataDiklat->setOutputDiklat($data->get('outputDiklat'));
        $dataDiklat->setOutcomeDiklat($data->get('outcomeDiklat'));

        if ($data->get('diklat') instanceof Diklat) {
            $dataDiklat->setDiklat($data->get('diklat'));
        }

        EntityManager::persist($dataDiklat);

        if ($flush) {
            EntityManager::flush();

            return $dataDiklat;
        }
    }

    /**
     * Delete DataDiklat
     *
     * @param DataDiklat $dataDiklat
     * @return bool
     * @throws DataDiklatDeleteException
     */
    public function delete(DataDiklat $dataDiklat)
    {
        EntityManager::remove($dataDiklat);
        EntityManager::flush();
    }

    /**
     * Find DataDiklat by id
     *
     * @param $id
     * @return DataDiklat
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
