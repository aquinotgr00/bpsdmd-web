<?php

namespace App\Services\Domain;

use App\Entities\Certificate;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class CertificateService
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
            ->from(Certificate::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Certificate::class);
    }

    /**
     * Get count Certificate
     *
     * @return int
     */
    public function getCountEmployee()
    {
        try {
            $qb = $this->createQueryBuilder('c');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate Certificate
     *
     * @param $page\
     * @return LengthAwarePaginator
     */
    public function paginateCertificate($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('e')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Certificate
     *
     * @param Collection $data
     * @param bool $flush
     * @return Certificate
     */
    public function create(Collection $data, $flush = true)
    {
        $certificate = new Certificate;
        $certificate->setName($data->get('name'));

        EntityManager::persist($certificate);

        if ($flush) {
            EntityManager::flush();

            return $certificate;
        }
    }

    /**
     * Update Certificate
     *
     * @param Certificate $certificate
     * @param Collection $data
     * @param bool $flush
     * @return Certificate
     */
    public function update(Certificate $certificate, Collection $data, $flush = true)
    {
        $certificate->setName($data->get('name'));

        EntityManager::persist($certificate);

        if ($flush) {
            EntityManager::flush();

            return $certificate;
        }
    }

    /**
     * Delete Certificate
     *
     * @param Certificate $certificate
     * @return bool
     * @throws CertificateDeleteException
     */
    public function delete(Certificate $certificate)
    {
        EntityManager::remove($certificate);
        EntityManager::flush();
    }

    /**
     * Find Certificate by id
     *
     * @param $id
     * @return Certificate
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
