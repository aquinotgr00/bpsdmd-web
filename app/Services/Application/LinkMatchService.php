<?php

namespace App\Services\Application;

use App\Entities\JobTitle;
use App\Entities\StudyProgram;
use App\Services\Domain\JobTitleService;
use App\Services\Domain\ProgramService;

class LinkMatchService
{
    /**
     * Match Demand
     *
     * @param StudyProgram $studyProgram
     * @return JobTitle[]|array
     */
    public function matchDemandByProgram(StudyProgram $studyProgram)
    {
        $licenses = [];

        // find license program
        foreach ($studyProgram->getLicenseStudyProgram() as $licenseStudyProgram) {
            $licenses[] = $licenseStudyProgram->getLicense();
        }

        // match with license job function
        /** @var JobTitleService $jobTitleService */
        $jobTitleService = app(JobTitleService::class);
        $jobTitles = $jobTitleService->findJobTitleFromLicenses($licenses);

        return $jobTitles;
    }

    /**
     * Match Supply
     *
     * @param JobTitle $jobTitle
     * @return array
     */
    public function matchSupplyByJobTitle(JobTitle $jobTitle)
    {
        /** @var JobTitleService $jobTitleService */
        $jobTitleService = app(JobTitleService::class);
        $licenses = $jobTitleService->getLicenseByJobTitle($jobTitle);

        /** @var ProgramService $programService */
        $programService = app(ProgramService::class);
        $programs = $programService->findProgramFromLicenses($licenses);

        return $programs;
    }

    /**
     * Mass update Relation Link and Match
     *
     * @param StudyProgram $program
     * @param array $licenses
     * @param array $jobTitles
     * @param array $deletedJobTitle
     */
    public function massUpdate(StudyProgram $program, array $licenses, array $jobTitles, array $deletedJobTitle)
    {
        /** @var ProgramService $programService */
        $programService = app(ProgramService::class);
        /** @var JobTitleService $jobTitleService */
        $jobTitleService = app(JobTitleService::class);

        $programService->setLicenses($program, $licenses, 'update');

        if (count($jobTitles)) {
            $jobTitleService->setLicensesForJobTitles($jobTitles, $licenses);
        }

        if (count($deletedJobTitle)) {
            $jobTitleService->unsetLicensesForJobTitles($deletedJobTitle, $licenses);
        }
    }
}
