<?php

namespace App\Services\Domain;

use App;
use App\Entities\License;
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
     * Paginate program
     *
     * @param int $page
     * @param Organization $org
     * @return LengthAwarePaginator
     */
    public function paginateProgram($page, Organization $org): LengthAwarePaginator
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
     * @param bool $org
     * @param bool $flush
     * @return StudyProgram
     */
    public function create(Collection $data, $org = false, $flush = true)
    {
        $program = new StudyProgram;
        $program->setIdDikti($data->get('id_dikti'));
        $program->setCode($data->get('code'));
        $program->setName($data->get('name'));
        $program->setStatus($data->get('status'));
        $program->setVision($data->get('vision'));
        $program->setMission($data->get('mission'));
        $program->setDegree($data->get('degree'));
        $program->setLetterOfEst($data->get('letter_of_est'));
        $program->setPassingGradeCredits($data->get('passing_grade_credits'));
        $program->setLastUpdate(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('est_date')) {
            $program->setEstDate(date_create_from_format('d-m-Y', $data->get('est_date')));
        }
        if ($data->get('date_of_est')) {
            $program->setDateOfEst(date_create_from_format('d-m-Y', $data->get('date_of_est')));
        }
        if ($org instanceof Organization) {
            $program->setOrg($org);
        }

        if($data->get('license')){
            $this->setLicenses($program, $data->get('license'));
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
     * @param bool $org
     * @param bool $flush
     * @return StudyProgram
     */
    public function update(StudyProgram $program, Collection $data, $org = false, $flush = true)
    {
        $program->setIdDikti($data->get('id_dikti'));
        $program->setCode($data->get('code'));
        $program->setName($data->get('name'));
        $program->setStatus($data->get('status'));
        $program->setVision($data->get('vision'));
        $program->setMission($data->get('mission'));
        $program->setDegree($data->get('degree'));
        $program->setLetterOfEst($data->get('letter_of_est'));
        $program->setPassingGradeCredits($data->get('passing_grade_credits'));
        $program->setLastUpdate(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('est_date')) {
            $program->setEstDate(date_create_from_format('d-m-Y', $data->get('est_date')));
        }
        if ($data->get('date_of_est')) {
            $program->setDateOfEst(date_create_from_format('d-m-Y', $data->get('date_of_est')));
        }
        if ($org instanceof Organization) {
            $program->setOrg($org);
        }

        if($data->get('license')){
            $this->setLicenses($program, $data->get('license'), 'update');
        }

        EntityManager::persist($program);

        if ($flush) {
            EntityManager::flush();

            return $program;
        }
    }

    /**
     * Set license program
     *
     * @param StudyProgram $studyProgram
     * @param array $licenses
     * @param string $type
     */
    private function setLicenses(StudyProgram $studyProgram, array $licenses = [], $type = 'create')
    {
        /** @var LicenseService $licenseService */
        $licenseService = app(LicenseService::class);
        /** @var LicenseProgramService $licenseProgramService */
        $licenseProgramService = app(LicenseProgramService::class);

        if ($type == 'update') {
            $licenseProgramService->delete($studyProgram);
        }

        if (count($licenses)) {
            foreach ($licenses as $licenseId) {
                $license = $licenseService->findById($licenseId);

                if ($license instanceof License) {
                    $licenseProgramService->create($studyProgram, $license);
                }
            }
        }
    }

    /**
     * Delete StudyProgram
     *
     * @param StudyProgram $program
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

    /**
     * Get StudyProgram by org
     *
     * @param string $org
     * @return StudyProgram[]
     */
    public function getProgramByOrg($org = 'all')
    {
        if ($org instanceof Organization) {
            return $this->getRepository()->findBy(['org' => $org]);
        }

        return $this->getRepository()->findAll();
    }
}
