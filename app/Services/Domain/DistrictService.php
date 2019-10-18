<?php

namespace App\Services\Domain;

use App\Entities\District;
use App\Entities\Province;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class DistrictService
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
            ->from(District::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(District::class);
    }

    /**
     * Paginate District
     *
     * @param $page\
     * @return LengthAwarePaginator
     */
    public function paginateDistrict($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('e')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new District
     *
     * @param Collection $data
     * @param bool $flush
     * @return District
     */
    public function create(Collection $data, $province = false, $flush = true)
    {
        $district = new District;
        $district->setName($data->get('name'));
        $district->setCode($data->get('code'));

        if ($province instanceof Province) {
            $district->setProvince($province);
        }

        EntityManager::persist($district);

        if ($flush) {
            EntityManager::flush();

            return $district;
        }
    }

    /**
     * Update District
     *
     * @param District $district
     * @param Collection $data
     * @param bool $flush
     * @return District
     */
    public function update(District $district, Collection $data, $flush = true)
    {
        $district->setName($data->get('name'));

        EntityManager::persist($district);

        if ($flush) {
            EntityManager::flush();

            return $district;
        }
    }

    /**
     * Delete District
     *
     * @param District $district
     * @return bool
     * @throws DistrictDeleteException
     */
    public function delete(District $district)
    {
        EntityManager::remove($district);
        EntityManager::flush();
    }

    /**
     * Find District by id
     *
     * @param $id
     * @return District
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return District[]
     */
    public function findByName(string $name)
    {
        $query = $this->createQueryBuilder('s')
            ->where('s.name LIKE :name')
            ->orderBy('s.name', 'asc')
            ->setParameter('name', "%$name%")
            ->getQuery()
            ->getArrayResult();

        return $query;
    }
}
