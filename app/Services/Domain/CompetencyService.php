<?php

namespace App\Services\Domain;

use App\Entities\Competency;
use App\Entities\CompetencyKeyFunction;
use App\Entities\CompetencyMainFunction;
use App\Entities\CompetencyMainPurpose;
use App\Entities\CompetencyUnit;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class CompetencyService
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
            ->from(Competency::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Competency::class);
    }

    /**
     * Paginate Competency
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateCompetency($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Competency
     *
     * @param Collection $data
     * @param CompetencyKeyFunction $ckf
     * @param CompetencyMainFunction $cmf
     * @param CompetencyMainPurpose $cmp
     * @param CompetencyUnit $cu
     * @param bool $flush
     * @return Competency
     */
    public function create(CompetencyKeyFunction $ckf, CompetencyMainFunction $cmf, CompetencyMainPurpose $cmp, CompetencyUnit $cu, Collection $data, $flush = true)
    {
        $competency = new Competency;
        $competency->setName($data->get('name'));
        $competency->setModa($data->get('moda'));
        $competency->setType($data->get('type'));
        $competency->setCompetencyKeyFunction($ckf);
        $competency->setCompetencyMainFunction($cmf);
        $competency->setCompetencyMainPurpose($cmp);
        $competency->setCompetencyUnit($cu);

        EntityManager::persist($competency);

        if ($flush) {
            EntityManager::flush();

            return $competency;
        }
    }

    /**
     * Update Competency
     *
     * @param Competency $competency
     * @param CompetencyKeyFunction $ckf
     * @param CompetencyMainFunction $cmf
     * @param CompetencyMainPurpose $cmp
     * @param CompetencyUnit $cu
     * @param Collection $data
     * @param bool $flush
     * @return Competency
     */
    public function update(Competency $competency, CompetencyKeyFunction $ckf, CompetencyMainFunction $cmf, CompetencyMainPurpose $cmp, CompetencyUnit $cu, Collection $data, $flush = true)
    {
        $competency->setName($data->get('name'));
        $competency->setModa($data->get('moda'));
        $competency->setType($data->get('type'));
        $competency->setCompetencyKeyFunction($ckf);
        $competency->setCompetencyMainFunction($cmf);
        $competency->setCompetencyMainPurpose($cmp);
        $competency->setCompetencyUnit($cu);

        EntityManager::persist($competency);

        if ($flush) {
            EntityManager::flush();

            return $competency;
        }
    }

    /**
     * Delete Competency
     *
     * @param Competency $competency
     */
    public function delete(Competency $competency)
    {
        EntityManager::remove($competency);
        EntityManager::flush();
    }
}
