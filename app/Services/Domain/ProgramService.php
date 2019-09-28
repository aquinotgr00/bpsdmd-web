<?php

namespace App\Services\Domain;

use App;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class ProgramService
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
            ->from(StudyProgram::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(StudyProgram::class);
    }

    /**
     * Paginate disease
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateProgram($page, $org): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.org = :orgId')
            ->orderBy('p.id')
            ->setParameter('orgId', $org->getId())
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new StudyProgram
     *
     * @param Collection $data
     * @param bool $flush
     * @return StudyProgram
     */
    public function create(Collection $data, $flush = true)
    {
        $program = new StudyProgram;
        $program->setCode($data->get('code'));
        $program->setName($data->get('name'));
        $program->setDegree($data->get('degree'));

        if ($data->get('org') instanceof Organization) {
            $program->setOrg($data->get('org'));
        }

        EntityManager::persist($program);

        if ($flush) {
            EntityManager::flush();

            return $program;
        }
    }

    /**
     * Update StudyProgram
     *
     * @param StudyProgram $program
     * @param Collection $data
     * @param bool $flush
     * @return StudyProgram
     */
    public function update(StudyProgram $program, Collection $data, $flush = true)
    {
        $program->setCode($data->get('code'));
        $program->setName($data->get('name'));
        $program->setDegree($data->get('degree'));

        if ($data->get('org') instanceof Organization) {
            $program->setOrg($data->get('org'));
        }

        EntityManager::persist($program);

        if ($flush) {
            EntityManager::flush();

            return $program;
        }
    }

    /**
     * Delete StudyProgram
     *
     * @param StudyProgram $program
     * @return bool
     * @throws ProgramDeleteException
     */
    public function delete(StudyProgram $program)
    {
        EntityManager::remove($program);
        EntityManager::flush();
    }

    /**
     * Find StudyProgram by id
     *
     * @param $id
     * @return StudyProgram
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}
