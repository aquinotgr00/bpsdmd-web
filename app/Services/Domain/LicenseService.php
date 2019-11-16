<?php

namespace App\Services\Domain;

use App\Entities\License;
use App\Entities\LicenseCompetency;
use App\Entities\LicenseStudyProgram;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class LicenseService
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
            ->from(License::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(License::class);
    }

    /**
     * Paginate license
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateLicense($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('l')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new License
     *
     * @param Collection $data
     * @param bool $flush
     * @return License
     */
    public function create(Collection $data, $flush = true)
    {
        $license = new License;
        $license->setCode($data->get('code'));
        $license->setName($data->get('name'));
        $license->setChapter($data->get('chapter'));
        $license->setModa($data->get('moda'));

        EntityManager::persist($license);

        if ($flush) {
            EntityManager::flush();

            return $license;
        }
    }

    /**
     * Update License
     *
     * @param License $license
     * @param Collection $data
     * @param bool $flush
     * @return License
     */
    public function update(License $license, Collection $data, $flush = true)
    {
        $license->setCode($data->get('code'));
        $license->setName($data->get('name'));
        $license->setChapter($data->get('chapter'));
        $license->setModa($data->get('moda'));

        EntityManager::persist($license);

        if ($flush) {
            EntityManager::flush();

            return $license;
        }
    }

    /**
     * Delete License
     *
     * @param License $license
     */
    public function delete(License $license)
    {
        EntityManager::remove($license);
        EntityManager::flush();
    }

    /**
     * Find License by id
     *
     * @param $id
     * @return License
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Get list license
     *
     * @param $exclude
     * @return mixed
     */
    public function getAsList($exclude = [])
    {
        $excludeIds = [];

        foreach ($exclude as $item) {
            $excludeIds[] = ($item instanceof LicenseStudyProgram || $item instanceof LicenseCompetency) ? $item->getLicense()->getId() : $item;
        }

        $qb = $this->createQueryBuilder('l');

        if (count($excludeIds)) {
            $query = $qb->where($qb->expr()->notIn('l.id', $excludeIds))
                ->orderBy('l.code ASC, l.chapter DESC')
                ->getQuery();
        } else {
            $query = $qb->getQuery();
        }

        return $query->getResult();
    }
}
