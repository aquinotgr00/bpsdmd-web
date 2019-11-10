<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\JobTitle;
use App\Entities\License;
use App\Entities\LicenseStudyProgram;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Services\Application\LinkMatchService;
use App\Services\Domain\JobTitleService;
use App\Services\Domain\OrgService;
use Illuminate\Http\Request;

class LinkMatchController extends Controller
{
    public function supply(OrgService $orgService)
    {
        $schools = $orgService->getSchoolAsList();

        return view('linkMatch.supply', compact('schools'));
    }

    public function demand()
    {
        return view('linkMatch.demand');
    }

    public function program(Request $request, Organization $organization)
    {
        if ($request->ajax()) {
            $result = [];
            $programs = $organization->getPrograms();

            /** @var StudyProgram $program */
            foreach ($programs as $program) {
                $result[] = [
                    'id' => $program->getId(),
                    'name' => $program->getName()
                ];
            }

            return response()->json($result);
        }

        return abort(404);
    }

    public function programLicense(Request $request, StudyProgram $studyProgram)
    {
        if ($request->ajax()) {
            $result = [];
            $licenses = $studyProgram->getLicenseStudyProgram();

            /** @var LicenseStudyProgram $lp */
            foreach ($licenses as $lp) {
                $result[] = [
                    'name' => $lp->getLicense()->getCode().' '.$lp->getLicense()->getChapter().' - '.$lp->getLicense()->getName()
                ];
            }

            return response()->json($result);
        }

        return abort(404);
    }

    public function demandByProgram(Request $request, LinkMatchService $linkMatchService, JobTitleService $jobTitleService, StudyProgram $studyProgram)
    {
        if ($request->ajax()) {
            $result = [];
            $jobTitles = $linkMatchService->matchDemandByProgram($studyProgram);

            /** @var JobTitle $jobTitle */
            foreach ($jobTitles as $jobTitle) {
                if (array_key_exists($jobTitle->getOrg()->getId(), $result)) {
                    $append = $result[$jobTitle->getOrg()->getId()];

                    $append['jobTitle'][] = [
                        'name' => $jobTitle->getName(),
                        'competencies' => $jobTitleService->getCompetencyJobTitle($jobTitle)
                    ];

                    $result[$jobTitle->getOrg()->getId()] = [
                        'company' => $jobTitle->getOrg()->getName(),
                        'logo' => $jobTitle->getOrg()->getPhoto() ? '/'.Organization::UPLOAD_PATH.'/'.$jobTitle->getOrg()->getPhoto() : '/img/avatar.png',
                        'jobTitle' => $append['jobTitle']
                    ];
                } else {
                    $result[$jobTitle->getOrg()->getId()] = [
                        'company' => $jobTitle->getOrg()->getName(),
                        'logo' =>  $jobTitle->getOrg()->getPhoto() ? '/'.Organization::UPLOAD_PATH.'/'.$jobTitle->getOrg()->getPhoto() : '/img/avatar.png',
                        'jobTitle' => [
                            [
                                'name' => $jobTitle->getName(),
                                'competencies' => $jobTitleService->getCompetencyJobTitle($jobTitle)
                            ],
                        ]
                    ];
                }
            }

            return response()->json($result);
        }

        return abort(404);
    }
}
