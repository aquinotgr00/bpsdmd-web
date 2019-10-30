<?php

namespace App\Services\Domain;

use App\Entities\JobFunction;
use App\Entities\Organization;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class JobFunctionService
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
            ->from(JobFunction::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(JobFunction::class);
    }

    /**
     * Paginate JobFunction
     *
     * @param $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateJobFunction($page, Organization $org): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('jf')
            ->andWhere('jf.org = :orgId')
            ->orderBy('jf.id')
            ->setParameter('orgId', $org->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new JobFunction
     *
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return JobFunction
     */
    public function create(Collection $data, Organization $org, $flush = true)
    {
        $jobFunction = new JobFunction;
        $jobFunction->setCode($data->get('code'));
        $jobFunction->setName($data->get('name'));
        $jobFunction->setOrg($org);

        if ($org instanceof Organization) {
            $jobFunction->setOrg($org);
        }

        EntityManager::persist($jobFunction);

        if ($flush) {
            EntityManager::flush();

            return $jobFunction;
        }
    }

    /**
     * Update JobFunction
     *
     * @param JobFunction $jobFunction
     * @param Collection $data
     * @param bool $org
     * @param bool $flush
     * @return JobFunction
     */
    public function update(JobFunction $jobFunction, Collection $data, Organization $org, $flush = true)
    {
        $jobFunction->setCode($data->get('code'));
        $jobFunction->setName($data->get('name'));
        $jobFunction->setOrg($org);

        EntityManager::persist($jobFunction);

        if ($flush) {
            EntityManager::flush();

            return $jobFunction;
        }
    }

    /**
     * Delete JobFunction
     *
     * @param JobFunction $jobFunction
     */
    public function delete(JobFunction $jobFunction)
    {
        EntityManager::remove($jobFunction);
        EntityManager::flush();
    }

    /**
     * Find JobFunction by id
     *
     * @param $id
     * @return JobFunction
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
