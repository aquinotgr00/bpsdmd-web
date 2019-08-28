<?php

namespace App\Services\Domain;

use App\Entities\Organization;
use App\Exceptions\OrgDeleteException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class OrgService
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
            ->from(Organization::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Organization::class);
    }

    /**
     * Paginate disease
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateOrg($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('o')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new organization
     *
     * @param Collection $data
     * @param bool $flush
     * @return Organization
     */
    public function create(Collection $data, $flush = true)
    {
        $org = new Organization;
        $org->setName($data->get('name'));
        $org->setName($data->get('short_name'));
        $org->setType($data->get('type'));
        EntityManager::persist($org);

        if ($flush) {
            EntityManager::flush();

            return $org;
        }
    }

    /**
     * Update organization
     *
     * @param Organization $org
     * @param Collection $data
     * @param bool $flush
     * @return Organization
     */
    public function update(Organization $org, Collection $data, $flush = true)
    {
        $org->setName($data->get('name'));
        $org->setName($data->get('short_name'));
        $org->setType($data->get('type'));
        EntityManager::persist($org);

        if ($flush) {
            EntityManager::flush();

            return $org;
        }
    }

    /**
     * Delete organization
     *
     * @param Organization $org
     * @return bool
     * @throws OrgDeleteException
     */
    public function delete(Organization $org)
    {
        $count = count($org->getUsers());

        if (!$count) {
            EntityManager::remove($org);
            EntityManager::flush();

            return true;
        }

        throw new OrgDeleteException('Cannot delete organization due to existing ' . $count . ' users!');
    }
}
