<?php

namespace App\Services\Domain;

use App\Entities\License;
use App\Entities\LicenseCompetency;
use App\Entities\Competency;
use DB;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class LicenseCompetencyService
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
            ->from(LicenseCompetency::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(LicenseCompetency::class);
    }

    /**
     * Create new LicenseCompetency
     *
     * @param Competency $competency
     * @param License $license
     * @param bool $flush
     * @return License|LicenseCompetency
     */
    public function create(Competency $competency, License $license, $flush = true)
    {
        $lp = new LicenseCompetency;
        $lp->setCompetency($competency);
        $lp->setLicense($license);

        EntityManager::persist($lp);

        if ($flush) {
            EntityManager::flush();

            return $license;
        }
    }

    /**
     * Delete LicenseCompetency
     *
     * @param Competency $competency
     */
    public function delete(Competency $competency)
    {
        DB::table('lisensi_kompetensi')
            ->where('kompetensi_id', '=', $competency->getId())
            ->delete();
    }

    /**
     * Delete LicenseCompetency
     *
     * @param License $license
     */
    public function deleteByLicense(License $license)
    {
        DB::table('lisensi_kompetensi')
            ->where('lisensi_id', '=', $license->getId())
            ->delete();
    }
}
