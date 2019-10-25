<?php

namespace App\Services\Domain;

use App\Entities\CompetencyUnit;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class CompetencyUnitService
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
            ->from(CompetencyUnit::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(CompetencyUnit::class);
    }

    /**
     * Paginate CompetencyUnit
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateCU($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new CompetencyUnit
     *
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyUnit
     */
    public function create(Collection $data, $flush = true)
    {
        $cu = new CompetencyUnit;
        $cu->setCode($data->get('code'));
        $cu->setUnit($data->get('text'));

        EntityManager::persist($cu);

        if ($flush) {
            EntityManager::flush();

            return $cu;
        }
    }

    /**
     * Update CompetencyUnit
     *
     * @param CompetencyUnit $cu
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyUnit
     */
    public function update(CompetencyUnit $cu, Collection $data, $flush = true)
    {
        $cu->setCode($data->get('code'));
        $cu->setUnit($data->get('text'));

        EntityManager::persist($cu);

        if ($flush) {
            EntityManager::flush();

            return $cu;
        }
    }

    /**
     * Delete CompetencyUnit
     *
     * @param CompetencyUnit $cu
     */
    public function delete(CompetencyUnit $cu)
    {
        EntityManager::remove($cu);
        EntityManager::flush();
    }
}
