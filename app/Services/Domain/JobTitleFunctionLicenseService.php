<?php

namespace App\Services\Domain;

use App\Entities\License;
use App\Entities\JobTitleFunctionLicense;
use App\Entities\JobTitleFunction;
use DB;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class JobTitleFunctionLicenseService
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
            ->from(JobTitleFunctionLicense::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(JobTitleFunctionLicense::class);
    }

    /**
     * Create new JobTitleFunctionLicense
     *
     * @param JobTitleFunction $jobTitleFunction
     * @param License $license
     * @param bool $flush
     * @return License|JobTitleFunctionLicense
     */
    public function create(JobTitleFunction $jobTitleFunction, License $license, $flush = true)
    {
        $jtl = new JobTitleFunctionLicense;
        $jtl->setJobTitleFunction($jobTitleFunction);
        $jtl->setLicense($license);

        EntityManager::persist($jtl);

        if ($flush) {
            EntityManager::flush();

            return $license;
        }
    }

    /**
     * Delete JobTitleFunctionLicense
     *
     * @param JobTitleFunction $jobTitleFunction
     */
    public function delete(JobTitleFunction $jobTitleFunction)
    {
        DB::table('jabatan_fungsi_pekerjaan_lisensi')
            ->where('jabatan_fungsi_pekerjaan_id', '=', $jobTitleFunction->getId())
            ->delete();
    }
}
