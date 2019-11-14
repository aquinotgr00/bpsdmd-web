<?php

namespace App\Services\Domain;

use App\Entities\JobTitle;
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
}
