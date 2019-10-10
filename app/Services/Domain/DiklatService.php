<?php

namespace App\Services\Domain;

use App\Entities\Diklat;
use App\Entities\Organization;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class DiklatService
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
            ->from(Diklat::class, $alias, $indexBy);
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
        return EntityManager::getRepository(Diklat::class);
    }

    /**
     * Paginate Diklat
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateDiklat($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('d')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Diklat
     *
     * @param Collection $data
     * @param bool $flush
     * @return Diklat
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $diklat = new Diklat;
        $diklat->setName($data->get('name'));
        $diklat->setType($data->get('type'));

        if ($org instanceof Organization) {
            $diklat->setOrg($org);
        }

        EntityManager::persist($diklat);

        if ($flush) {
            EntityManager::flush();

            return $diklat;
        }
    }

    /**
     * Update Diklat
     *
     * @param Diklat $diklat
     * @param Collection $data
     * @param bool $flush
     * @return Diklat
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Diklat $diklat, Collection $data, $org = false, $flush = true)
    {
        $diklat->setName($data->get('name'));
        $diklat->setType($data->get('type'));

        if ($org instanceof Organization) {
            $diklat->setOrg($org);
        }

        EntityManager::persist($diklat);

        if ($flush) {
            EntityManager::flush();

            return $diklat;
        }
    }

    /**
     * Delete Diklat
     *
     * @param Diklat $diklat
     * @return bool
     * @throws ProgramDeleteException
     */
    public function delete(Diklat $diklat)
    {
        EntityManager::remove($diklat);
        EntityManager::flush();
    }

    /**
     * Find Diklat by id
     *
     * @param $id
     * @return Diklat
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
