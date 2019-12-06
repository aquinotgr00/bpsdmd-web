<?php

namespace App\Services\Domain;

use App\Entities\JobTitle;
use App\Entities\JobFunction;
use App\Entities\JobTitleFunction;
use App\Entities\JobTitleFunctionLicense;
use App\Entities\License;
use App\Entities\Organization;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class JobTitleService
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
            ->from(JobTitle::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(JobTitle::class);
    }

    /**
     * Get count JobTitle
     *
     * @return int
     */
    public function getCountJobTitle()
    {
        try {
            $qb = $this->createQueryBuilder('jt');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate JobTitle
     *
     * @param $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateJobTitle($page, Organization $org): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('jt')
            ->andWhere('jt.org = :orgId')
            ->orderBy('jt.id')
            ->setParameter('orgId', $org->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new JobTitle
     *
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return JobTitle
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $jobTitle = new JobTitle;
        $jobTitle->setCode($data->get('code'));
        $jobTitle->setName($data->get('name'));
        $jobTitle->setEducationMinimal($data->get('education_minimal'));
        $jobTitle->setGpaMinimal($data->get('gpa_minimal'));
        $jobTitle->setAgeMinimal($data->get('age_minimal'));
        $jobTitle->setExperienceMinimal($data->get('experience_minimal'));

        if ($org instanceof Organization) {
            $jobTitle->setOrg($org);
        }

        if($data->get('job_function_exist') && count($data->get('license', []))){
            $this->setJobFunctions($jobTitle, $data->get('job_function'), $data->get('license'));
        }

        EntityManager::persist($jobTitle);

        if ($flush) {
            EntityManager::flush();

            return $jobTitle;
        }
    }

    /**
     * Update JobTitle
     *
     * @param JobTitle $jobTitle
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return JobTitle
     */
    public function update(JobTitle $jobTitle, Collection $data, $org = false, $flush = true)
    {
        $jobTitle->setCode($data->get('code'));
        $jobTitle->setName($data->get('name'));
        $jobTitle->setEducationMinimal($data->get('education_minimal'));
        $jobTitle->setGpaMinimal($data->get('gpa_minimal'));
        $jobTitle->setAgeMinimal($data->get('age_minimal'));
        $jobTitle->setExperienceMinimal($data->get('experience_minimal'));

        if ($org instanceof Organization) {
            $jobTitle->setOrg($org);
        }

        if($data->get('job_function_exist') && count($data->get('license', []))){
            $this->setJobFunctions($jobTitle, $data->get('job_function'), $data->get('license'), 'update');
        }

        EntityManager::persist($jobTitle);

        if ($flush) {
            EntityManager::flush();

            return $jobTitle;
        }
    }

    /**
     * Delete JobTitle
     *
     * @param JobTitle $jobTitle
     */
    public function delete(JobTitle $jobTitle)
    {
        EntityManager::remove($jobTitle);
        EntityManager::flush();
    }

    /**
     * Find JobTitle by id
     *
     * @param $id
     * @return JobTitle
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Set jobFunction jobTitle
     *
     * @param JobTitle $jobTitle
     * @param array $jobFunctions
     * @param string $type
     */
    private function setJobFunctions(JobTitle $jobTitle, array $jobFunctions = [], array $licenses = [], $type = 'create')
    {
        /** @var JobFunctionService $jobFunctionService */
        $jobFunctionService = app(JobFunctionService::class);
        /** @var JobTitleFunctionService $jobTitleFunctionService */
        $jobTitleFunctionService = app(JobTitleFunctionService::class);

        if ($type == 'update') {
            $jobTitleFunctionService->delete($jobTitle);
        }

        if (count($jobFunctions)) {
            foreach ($jobFunctions as $jobFunctionId) {
                $jobFunction = $jobFunctionService->findById($jobFunctionId);

                if ($jobFunction instanceof JobFunction) {
                    $jobTitleFunctionService->create($jobTitle, $jobFunction, isset($licenses[$jobFunctionId]) ? $licenses[$jobFunctionId] : $licenses);
                }
            }
        }
    }

    /**
     * Find job title from licenses
     *
     * @param array $licenses
     * @return array|JobTitle[]
     */
    public function findJobTitleFromLicenses(array $licenses)
    {
        $licenseIds = [];
        $jobTitle = [];

        /** @var License $license */
        foreach ($licenses as $license) {
            $licenseIds[] = $license->getId();
        }

        if (count($licenseIds)) {
            $qb = EntityManager::createQueryBuilder()
                ->select('jfl')
                ->from(JobTitleFunctionLicense::class, 'jfl');

            $query = $qb->where($qb->expr()->in('jfl.license', array_unique($licenseIds)))
                ->getQuery();

            $jfls = $query->getResult();

            /** @var JobTitleFunctionLicense $jfl */
            foreach ($jfls as $jfl) {
                $jobTitle[] = $jfl->getJobTitleFunction()->getJobTitle();
            }

            return $jobTitle;
        }

        return [];
    }

    /**
     * Get competency job title
     *
     * @param JobTitle $jobTitle
     * @return array
     */
    public function getCompetencyJobTitle(JobTitle $jobTitle)
    {
        $licenses = [];
        /** @var CompetencyService $competencyService */
        $competencyService = app(CompetencyService::class);

        $qb = EntityManager::createQueryBuilder()
            ->select('jtf')
            ->from(JobTitleFunction::class, 'jtf')
            ->where('jtf.jobTitle = :jobTitle')
            ->setParameter('jobTitle', $jobTitle);

        $jtfs = $qb->getQuery()->getResult();

        /** @var JobTitleFunction $jtf */
        foreach ($jtfs as $jtf) {
            /** @var JobTitleFunctionLicense $item */
            foreach ($jtf->getJobTitleFunctionLicense() as $item) {
                $licenses[$item->getLicense()->getId()] = $item->getLicense()->getId();
            }
        }

        return $competencyService->getCompetencyByLicenses($licenses);
    }

    /**
     * Get license by job title
     *
     * @param JobTitle $jobTitle
     * @return array
     */
    public function getLicenseByJobTitle(JobTitle $jobTitle)
    {
        $licenses = [];

        $qb = EntityManager::createQueryBuilder()
            ->select('jfl')
            ->from(JobTitleFunctionLicense::class, 'jfl')
            ->join('jfl.jobTitleFunction', 'jtf');

        $query = $qb->where('jtf.jobTitle = :jobTitle')
            ->setParameter('jobTitle', $jobTitle)
            ->getQuery();

        $jfls = $query->getResult();

        /** @var JobTitleFunctionLicense $jfl */
        foreach ($jfls as $jfl) {
            $licenses[$jfl->getLicense()->getId()] = $jfl->getLicense();
        }

        return $licenses;
    }

    /**
     * Get job title by licenses
     *
     * @param $moda
     * @param array $selectedLicenses
     * @return array
     */
    public function getJobTitleByLicenses($moda, array $selectedLicenses)
    {
        if (count($selectedLicenses)) {
            $jobTitles = [];

            $qb = EntityManager::createQueryBuilder()
                ->select('jfl')
                ->from(JobTitleFunctionLicense::class, 'jfl');

            $query = $qb->where($qb->expr()->in('jfl.license', array_unique($selectedLicenses)))
                ->getQuery();

            $result = $query->getResult();

            /** @var JobTitleFunctionLicense $jfl */
            foreach ($result as $jfl) {
                if ($jfl->getJobTitleFunction()->getJobTitle()->getOrg()->getModa() == $moda) {
                    $jobTitles[$jfl->getJobTitleFunction()->getJobTitle()->getId()] = $jfl->getJobTitleFunction()->getJobTitle();
                }
            }

            return $jobTitles;
        }

        return [];
    }

    /**
     * Get list Job Title by Org
     *
     * @param Organization $organization
     * @return array
     */
    public function getByOrganization(Organization $organization)
    {
        $jobTitles = [];
        $query = $this->createQueryBuilder('jt')
            ->andWhere('jt.org = :orgId')
            ->orderBy('jt.id')
            ->setParameter('orgId', $organization)
            ->getQuery();

        $result = $query->getResult();

        /** @var JobTitle $item */
        foreach ($result as $item) {
            $jobTitles[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }

        return $jobTitles;
    }

    /**
     * Set Licenses for Job Titles
     *
     * @param array $jobTitles
     * @param array $licenses
     */
    public function setLicensesForJobTitles(array $jobTitles, array $licenses)
    {
        /** @var JobTitleService $jobTitleService */
        $jobTitleService = app(JobTitleService::class);
        /** @var JobTitleFunctionService $jobTitleFunctionService */
        $jobTitleFunctionService = app(JobTitleFunctionService::class);

        /** @var JobTitle $jobTitle */
        foreach ($jobTitles as $jobTitle) {
            $jobTitle = $jobTitleService->findById($jobTitle);

            if ($jobTitle instanceof JobTitle) {
                $jfs = $jobTitle->getJobTitleFunction();

                foreach ($jfs as $jf) {
                    $jobTitleFunctionService->setLicenses($jf, $licenses, 'update');
                }
            }
        }
    }

    public function unsetLicensesForJobTitles(array $deletedJobTitle, array $licenses)
    {
        $qb = EntityManager::createQueryBuilder()
            ->select('jfl')
            ->from(JobTitleFunctionLicense::class, 'jfl');

        $query = $qb->where($qb->expr()->in('jfl.license', array_unique($licenses)))
            ->getQuery();

        $result = $query->getResult();

        /** @var JobTitleFunctionLicense $item */
        foreach ($result as $item) {
            if (in_array($item->getJobTitleFunction()->getJobTitle()->getId(), $deletedJobTitle)) {
                EntityManager::remove($item);
                EntityManager::flush();
            }
        }
    }
}
