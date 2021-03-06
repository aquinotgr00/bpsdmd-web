<?php

namespace App\Services\Domain;

use App\Entities\Competency;
use App\Entities\CompetencyKeyFunction;
use App\Entities\CompetencyMainFunction;
use App\Entities\CompetencyMainPurpose;
use App\Entities\CompetencyUnit;
use App\Entities\License;
use App\Entities\LicenseCompetency;
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

        if($data->get('license', [])){
            $this->setLicenses($competency, $data->get('license'));
        }

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

        if($data->get('license', [])){
            $this->setLicenses($competency, $data->get('license'), 'update');
        }

        EntityManager::persist($competency);

        if ($flush) {
            EntityManager::flush();

            return $competency;
        }
    }

    /**
     * Set license competency
     *
     * @param Competency $competency
     * @param array $licenses
     * @param string $type
     */
    private function setLicenses(Competency $competency, array $licenses = [], $type = 'create')
    {
        /** @var LicenseService $licenseService */
        $licenseService = app(LicenseService::class);
        /** @var LicenseCompetencyService $licenseCompetencyService */
        $licenseCompetencyService = app(LicenseCompetencyService::class);

        if ($type == 'update') {
            $licenseCompetencyService->delete($competency);
        }

        if (count($licenses)) {
            foreach ($licenses as $licenseId) {
                $license = $licenseService->findById($licenseId);

                if ($license instanceof License) {
                    $licenseCompetencyService->create($competency, $license);
                }
            }
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

    /**
     * Get competency by licenses
     *
     * @param array $licenses
     * @return array
     */
    public function getCompetencyByLicenses(array $licenses)
    {
        $competencies = [];

        if (count($licenses)) {
            $qb = EntityManager::createQueryBuilder()
                ->select('lc')
                ->from(LicenseCompetency::class, 'lc');

            $result = $qb->where($qb->expr()->in('lc.license', array_unique($licenses)))
                ->getQuery()
                ->getResult();

            /** @var LicenseCompetency $item */
            foreach ($result as $item) {
                $competencies[$item->getCompetency()->getCompetencyMainFunction()->getId()] = $item->getCompetency()->getCompetencyMainFunction()->getMainFunction();
            }
        }

        return $competencies;
    }

    /**
     * Get list competency
     *
     * @param array $exclude
     * @return mixed
     */
    public function getAsList($exclude = [])
    {
        $excludeIds = [];

        foreach ($exclude as $item) {
            if (is_array($item)) {
                foreach ($item as $value) {
                    $excludeIds[] = $value;
                }
            } else {
                $excludeIds[] = $item instanceof LicenseCompetency ? $item->getCompetency()->getId() : $item;
            }
        }

        $qb = $this->createQueryBuilder('c');

        if (count($excludeIds)) {
            $query = $qb->where($qb->expr()->notIn('c.id', $excludeIds))
                ->addOrderBy('c.moda','ASC')
                ->addOrderBy('c.type', 'ASC')
                ->getQuery();
        } else {
            $query = $qb
                ->addOrderBy('c.moda','ASC')
                ->addOrderBy('c.type', 'ASC')
                ->getQuery();
        }

        return $query->getResult();
    }

    /**
     * Find Competency by id
     *
     * @param $id
     * @return License
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
