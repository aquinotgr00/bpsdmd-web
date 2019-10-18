<?php

namespace App\Services\Domain;

use App\Entities\ShortCourseParticipant;
use App\Entities\ShortCourse;
use App\Entities\Employee;
use App\Entities\District;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class ShortCourseParticipantService
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
            ->from(ShortCourseParticipant::class, $alias, $indexBy);
    }

    /**
     * @param $dql
     * @return \Doctrine\ORM\Query
     */
    public function createQuery($dql)
    {
        return EntityManager::createQuery($dql);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(ShortCourseParticipant::class);
    }

    /**
     * Paginate ShortCourseParticipant
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateShortCourseParticipant($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('scd')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new ShortCourseParticipant
     *
     * @param Collection $data
     * @param bool $flush
     * @return ShortCourseParticipant
     */
    public function create(Collection $data, $shortCourse = false, $employee = false, $district = false, $flush = true)
    {
        $shortCourseParticipant = new ShortCourseParticipant;
        $shortCourseParticipant->setBackground($data->get('background'));
        $shortCourseParticipant->setGraduate($data->get('graduate'));
        $shortCourseParticipant->setCompetenceCertificat($data->get('competence_certificat'));
        $shortCourseParticipant->setTrainingCertificat($data->get('training_certificat'));
        
        if ($shortCourse instanceof ShortCourse) {
            $shortCourseParticipant->setShortCourse($shortCourse);
        }

        if ($employee instanceof Employee) {
            $shortCourseParticipant->setEmployee($employee);
        }

        if ($district instanceof District) {
            $shortCourseParticipant->setDistrict($district);
        }

        EntityManager::persist($shortCourseParticipant);

        if ($flush) {
            EntityManager::flush();

            return $shortCourseParticipant;
        }
    }

    /**
     * Update ShortCourseParticipant
     *
     * @param ShortCourseParticipant $shortCourseParticipant
     * @param Collection $data
     * @param bool $flush
     * @return ShortCourseParticipant
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(ShortCourseParticipant $shortCourseParticipant, Collection $data, $shortCourse = false, $flush = true)
    {
        if ($shortCourse instanceof ShortCourse) {
            $shortCourseParticipant->setShortCourse($shortCourse);
        }

        EntityManager::persist($shortCourseParticipant);

        if ($flush) {
            EntityManager::flush();

            return $shortCourseParticipant;
        }
    }

    /**
     * Delete ShortCourseParticipant
     *
     * @param ShortCourseParticipant $shortCourseParticipant
     * @return bool
     * @throws ShortCourseParticipantDeleteException
     */
    public function delete(ShortCourseParticipant $shortCourseParticipant)
    {
        EntityManager::remove($shortCourseParticipant);
        EntityManager::flush();
    }

    /**
     * Find ShortCourseParticipant by id
     *
     * @param $id
     * @return ShortCourseParticipant
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
