<?php

namespace App\Services\Domain;

use App\Entities\CompetencyKeyFunction;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class CompetencyKeyFunctionService
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
            ->from(CompetencyKeyFunction::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(CompetencyKeyFunction::class);
    }

    /**
     * Paginate CompetencyKeyFunction
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateCKF($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('ckf')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new CompetencyKeyFunction
     *
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyKeyFunction
     */
    public function create(Collection $data, $flush = true)
    {
        $ckf = new CompetencyKeyFunction;
        $ckf->setCode($data->get('code'));
        $ckf->setKeyFunction($data->get('text'));

        EntityManager::persist($ckf);

        if ($flush) {
            EntityManager::flush();

            return $ckf;
        }
    }

    /**
     * Update CompetencyKeyFunction
     *
     * @param CompetencyKeyFunction $cfk
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyKeyFunction
     */
    public function update(CompetencyKeyFunction $cfk, Collection $data, $flush = true)
    {
        $cfk->setCode($data->get('code'));
        $cfk->setKeyFunction($data->get('text'));

        EntityManager::persist($cfk);

        if ($flush) {
            EntityManager::flush();

            return $cfk;
        }
    }

    /**
     * Delete CompetencyKeyFunction
     *
     * @param CompetencyKeyFunction $cfk
     */
    public function delete(CompetencyKeyFunction $cfk)
    {
        EntityManager::remove($cfk);
        EntityManager::flush();
    }
}
