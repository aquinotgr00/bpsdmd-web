<?php

namespace App\Services\Domain;

use App\Entities\Teacher;
use App\Entities\Organization;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class TeacherService
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
            ->from(Teacher::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Teacher::class);
    }

    /**
     * Get count teacher
     *
     * @return int
     */
    public function getCountTeacher()
    {
        try {
            $qb = $this->createQueryBuilder('t');

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Paginate teacher
     *
     * @param $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateTeacher($page, Organization $org): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('t')
            ->andWhere('t.org = :orgId')
            ->orderBy('t.id')
            ->setParameter('orgId', $org->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new Teacher
     *
     * @param Collection $data
     * @param bool $flush
     * @return Teacher
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $teacher = new Teacher;
        $teacher->setCode($data->get('code'));
        $teacher->setNip($data->get('nip'));
        $teacher->setName($data->get('name'));
        $teacher->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $teacher->setFrontDegree($data->get('front_degree'));
        $teacher->setBackDegree($data->get('back_degree'));
        $teacher->setIdentityNumber($data->get('identity_number'));
        $teacher->setNidn($data->get('nidn'));

        if ($org instanceof Organization) {
            $teacher->setOrg($org);
        }

        if ($data->get('uploaded_img')) {
            $teacher->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($teacher);

        if ($flush) {
            EntityManager::flush();

            return $teacher;
        }
    }

    /**
     * Update Teacher
     *
     * @param Teacher $teacher
     * @param Collection $data
     * @param bool $flush
     * @return Teacher
     */
    public function update(Teacher $teacher, Collection $data, $org = false, $flush = true)
    {
        $teacher->setCode($data->get('code'));
        $teacher->setNip($data->get('nip'));
        $teacher->setName($data->get('name'));
        $teacher->setDateOfBirth(date_create_from_format('d-m-Y', $data->get('dateOfBirth')));
        $teacher->setFrontDegree($data->get('front_degree'));
        $teacher->setBackDegree($data->get('back_degree'));
        $teacher->setIdentityNumber($data->get('identity_number'));
        $teacher->setNidn($data->get('nidn'));

        if ($org instanceof Organization) {
            $teacher->setOrg($org);
        }

        if ($data->get('uploaded_img')) {
            @unlink(public_path(Teacher::UPLOAD_PATH).'/'.$teacher->getPhoto());
            $teacher->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($teacher);

        if ($flush) {
            EntityManager::flush();

            return $teacher;
        }
    }

    /**
     * Delete Teacher
     *
     * @param Teacher $teacher
     * @return bool
     * @throws TeacherDeleteException
     */
    public function delete(Teacher $teacher)
    {
        EntityManager::remove($teacher);
        EntityManager::flush();
    }

    /**
     * Find Teacher by id
     *
     * @param $id
     * @return Teacher
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
