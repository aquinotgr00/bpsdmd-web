<?php

namespace App\Services\Domain;

use App\Entities\CompetencyMainFunction;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class CompetencyMainFunctionService
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
            ->from(CompetencyMainFunction::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(CompetencyMainFunction::class);
    }

    /**
     * Paginate CompetencyMainFunction
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateCMF($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('cmf')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new CompetencyMainFunction
     *
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyMainFunction
     */
    public function create(Collection $data, $flush = true)
    {
        $cmf = new CompetencyMainFunction;
        $cmf->setCode($data->get('code'));
        $cmf->setMainFunction($data->get('text'));

        EntityManager::persist($cmf);

        if ($flush) {
            EntityManager::flush();

            return $cmf;
        }
    }

    /**
     * Update CompetencyMainFunction
     *
     * @param CompetencyMainFunction $cmf
     * @param Collection $data
     * @param bool $flush
     * @return CompetencyMainFunction
     */
    public function update(CompetencyMainFunction $cmf, Collection $data, $flush = true)
    {
        $cmf->setCode($data->get('code'));
        $cmf->setMainFunction($data->get('text'));

        EntityManager::persist($cmf);

        if ($flush) {
            EntityManager::flush();

            return $cmf;
        }
    }

    /**
     * Delete CompetencyMainFunction
     *
     * @param CompetencyMainFunction $cmf
     */
    public function delete(CompetencyMainFunction $cmf)
    {
        EntityManager::remove($cmf);
        EntityManager::flush();
    }
}
