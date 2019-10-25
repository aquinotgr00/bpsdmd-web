<?php

namespace App\Services\Domain;

use App\Entities\CompetencyMainPurpose;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class CompetencyMainPurposeService
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
            ->from(CompetencyMainPurpose::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(CompetencyMainPurpose::class);
    }

    /**
     * Paginate CompetencyMainPurpose
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateCMP($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('cmp')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new CompetencyMainPurpose
     *
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyMainPurpose
     */
    public function create(Collection $data, $flush = true)
    {
        $cmp = new CompetencyMainPurpose;
        $cmp->setCode($data->get('code'));
        $cmp->setMainPurpose($data->get('text'));

        EntityManager::persist($cmp);

        if ($flush) {
            EntityManager::flush();

            return $cmp;
        }
    }

    /**
     * Update CompetencyMainPurpose
     *
     * @param CompetencyMainPurpose $cmp
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyMainPurpose
     */
    public function update(CompetencyMainPurpose $cmp, Collection $data, $flush = true)
    {
        $cmp->setCode($data->get('code'));
        $cmp->setMainPurpose($data->get('text'));

        EntityManager::persist($cmp);

        if ($flush) {
            EntityManager::flush();

            return $cmp;
        }
    }

    /**
     * Delete CompetencyMainPurpose
     *
     * @param CompetencyMainPurpose $cmp
     */
    public function delete(CompetencyMainPurpose $cmp)
    {
        EntityManager::remove($cmp);
        EntityManager::flush();
    }
}
