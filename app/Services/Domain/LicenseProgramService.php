<?php

namespace App\Services\Domain;

use App\Entities\License;
use App\Entities\LicenseStudyProgram;
use App\Entities\StudyProgram;
use DB;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class LicenseProgramService
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
            ->from(LicenseStudyProgram::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(LicenseStudyProgram::class);
    }

    /**
     * Create new LicenseStudyProgram
     *
     * @param StudyProgram $studyProgram
     * @param License $license
     * @param bool $flush
     * @return License|LicenseStudyProgram
     */
    public function create(StudyProgram $studyProgram, License $license, $flush = true)
    {
        $lp = new LicenseStudyProgram;
        $lp->setStudyProgram($studyProgram);
        $lp->setLicense($license);

        EntityManager::persist($lp);

        if ($flush) {
            EntityManager::flush();

            return $license;
        }
    }

    /**
     * Delete LicenseStudyProgram
     *
     * @param StudyProgram $studyProgram
     */
    public function delete(StudyProgram $studyProgram)
    {
        DB::table('lisensi_program_studi')
            ->where('program_studi_id', '=', $studyProgram->getId())
            ->delete();
    }
}
