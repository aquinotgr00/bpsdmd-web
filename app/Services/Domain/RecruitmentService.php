<?php

namespace App\Services\Domain;

use App\Entities\Recruitment;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class RecruitmentService
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
            ->from(Recruitment::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Recruitment::class);
    }

    /**
     * Get count Recruitment
     *
     * @return int
     */
    public function getCountRecruitment()
    {
        try {
            $qb = $this->createQueryBuilder('r');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate Recruitment
     *
     * @param $page\
     * @param Collection $search
     * @return LengthAwarePaginator
     */
    public function paginateRecruitment($page): LengthAwarePaginator
    {
        // var_dump($search['ipk']);exit;
        $limit = 10;
        $query = $this->createQueryBuilder('r')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Recruitment
     *
     * @param Collection $data
     * @param bool $flush
     * @return Recruitment
     */
    public function create(Collection $data, $flush = true)
    {
        $recruitment = new Recruitment;
        $recruitment->setStatus($data->get('status'));
        $recruitment->setInputDate(date_create_from_format('d-m-Y', $data->get('inputDate')));
        $recruitment->setUpdateDate(date_create_from_format('d-m-Y', $data->get('updateDate')));
        $recruitment->setIsEmail($data->get('isEmail'));
        $recruitment->setEmailDate(date_create_from_format('d-m-Y', $data->get('emailDate')));

        EntityManager::persist($recruitment);

        if ($flush) {
            EntityManager::flush();

            return $recruitment;
        }
    }

    /**
     * Update Recruitment
     *
     * @param Recruitment $recruitment
     * @param Collection $data
     * @param bool $flush
     * @return Recruitment
     */
    public function update(Recruitment $recruitment, Collection $data, $flush = true)
    {
        $recruitment->setStatus($data->get('status'));
        $recruitment->setInputDate(date_create_from_format('d-m-Y', $data->get('inputDate')));
        $recruitment->setUpdateDate(date_create_from_format('d-m-Y', $data->get('updateDate')));
        $recruitment->setIsEmail($data->get('isEmail'));
        $recruitment->setEmailDate(date_create_from_format('d-m-Y', $data->get('emailDate')));

        EntityManager::persist($recruitment);

        if ($flush) {
            EntityManager::flush();

            return $recruitment;
        }
    }

    /**
     * Delete Recruitment
     *
     * @param Recruitment $recruitment
     * @return bool
     * @throws CertificateDeleteException
     */
    public function delete(Recruitment $recruitment)
    {
        EntityManager::remove($recruitment);
        EntityManager::flush();
    }

    /**
     * Find Recruitment by id
     *
     * @param $id
     * @return Recruitment
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
