<?php

namespace App\Services\Application;

use App\Entities\JobTitle;
use App\Entities\StudyProgram;
use App\Services\Domain\JobTitleService;

class LinkMatchService
{
    /**
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
}
