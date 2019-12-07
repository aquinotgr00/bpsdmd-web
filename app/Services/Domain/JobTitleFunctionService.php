<?php

namespace App\Services\Domain;

use App\Entities\JobFunction;
use App\Entities\JobTitleFunction;
use App\Entities\JobTitle;
use App\Entities\License;
use DB;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class JobTitleFunctionService
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
            ->from(JobTitleFunction::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(JobTitleFunction::class);
    }

    /**
     * Create new JobTitleFunction
     *
     * @param JobTitle $jobTitle
     * @param JobFunction $jobFunction
     * @param bool $flush
     * @return JobFunction|JobTitleFunction
     */
    public function create(JobTitle $jobTitle, JobFunction $jobFunction, array $licenses = [], $flush = true)
    {
        $jtf = new JobTitleFunction;
        $jtf->setJobTitle($jobTitle);
        $jtf->setJobFunction($jobFunction);

        if($licenses){
            $this->setLicenses($jtf, $licenses);
        }

        EntityManager::persist($jtf);

        if ($flush) {
            EntityManager::flush();

            return $jobFunction;
        }
    }

    /**
     * Delete JobTitleFunction
     *
     * @param JobTitle $jobTitle
     */
    public function delete(JobTitle $jobTitle)
    {
        DB::table('jabatan_fungsi_pekerjaan')
            ->where('jabatan_id', '=', $jobTitle->getId())
            ->delete();
    }

    /**
     * Set license jobTitleFunction
     *
     * @param JobTitleFunction $jobTitleFunction
     * @param array $licenses
     * @param string $type
     */
    public function setLicenses(JobTitleFunction $jobTitleFunction, array $licenses = [], $type = 'create')
    {
        /** @var LicenseService $licenseService */
        $licenseService = app(LicenseService::class);
        /** @var JobTitleFunctionLicenseService $jobTitleFunctionLicenseService */
        $jobTitleFunctionLicenseService = app(JobTitleFunctionLicenseService::class);

        if ($type == 'update') {
            $jobTitleFunctionLicenseService->delete($jobTitleFunction);
        }

        if (count($licenses)) {
            foreach ($licenses as $licenseId) {
                $license = $licenseService->findById($licenseId);

                if ($license instanceof License) {
                    $jobTitleFunctionLicenseService->create($jobTitleFunction, $license);
                }
            }
        }
    }
}
