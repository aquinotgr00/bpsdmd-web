<?php

namespace App\Services\Domain;

use App\Entities\JobTitle;
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
     * @param $page\
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
     * @param bool $flush
     * @return JobTitle
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $jobTitle = new JobTitle;
        $jobTitle->setName($data->get('name'));

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
     * @param bool $flush
     * @return JobTitle
     */
    public function update(JobTitle $jobTitle, Collection $data, $org = false, $flush = true)
    {
        $jobTitle->setName($data->get('name'));

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
     * @return bool
     * @throws JobTitleDeleteException
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
}
