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
use App\Services\Domain\ProgramService;
use Illuminate\Http\Request;

class LinkMatchController extends Controller
{
    public function supply(OrgService $orgService)
    {
        $schools = $orgService->getSchoolAsList();

        return view('linkMatch.supply', compact('schools'));
    }

    public function demand(OrgService $orgService)
    {
        $demands = $orgService->getDemandAsList();

        return view('linkMatch.demand', compact('demands'));
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

    public function programLicense(Request $request, ProgramService $programService, StudyProgram $studyProgram)
    {
        if ($request->ajax()) {
            $licenses = $programService->getLicenseByProgram($studyProgram, true);

            return response()->json($licenses);
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
                        'logo' => $jobTitle->getOrg()->getLogo() ? '/'.Organization::UPLOAD_PATH.'/'.$jobTitle->getOrg()->getLogo() : '/img/avatar.png',
                        'jobTitle' => $append['jobTitle']
                    ];
                } else {
                    $result[$jobTitle->getOrg()->getId()] = [
                        'company' => $jobTitle->getOrg()->getName(),
                        'logo' =>  $jobTitle->getOrg()->getLogo() ? '/'.Organization::UPLOAD_PATH.'/'.$jobTitle->getOrg()->getLogo() : '/img/avatar.png',
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

    public function jobTitle(Request $request, Organization $organization)
    {
        if ($request->ajax()) {
            $result = [];
            $jobTitles = $organization->getJobTitles();

            /** @var JobTitle $jobTitle */
            foreach ($jobTitles as $jobTitle) {
                $result[] = [
                    'id' => $jobTitle->getId(),
                    'name' => $jobTitle->getName()
                ];
            }

            return response()->json($result);
        }

        return abort(404);
    }

    public function jobTitleLicense(Request $request, JobTitleService $jobTitleService, JobTitle $jobTitle)
    {
        if ($request->ajax()) {
            $result = [];
            $licenses = $jobTitleService->getLicenseByJobTitle($jobTitle);

            /** @var License $license */
            foreach ($licenses as $license) {
                $result[] = [
                    'name' => $license->getCode().' '.$license->getChapter().' - '.$license->getName()
                ];
            }

            return response()->json($result);
        }

        return abort(404);
    }

    public function supplyByJobTitle(Request $request, LinkMatchService $linkMatchService, ProgramService $programService, JobTitle $program)
    {
        if ($request->ajax()) {
            $result = [];
            $programs = $linkMatchService->matchSupplyByJobTitle($program);

            /** @var StudyProgram $program */
            foreach ($programs as $program) {
                if (array_key_exists($program->getOrg()->getId(), $result)) {
                    $append = $result[$program->getOrg()->getId()];

                    $append['program'][] = [
                        'name' => $program->getName(),
                        'competencies' => $programService->getCompetencyProgram($program)
                    ];

                    $result[$program->getOrg()->getId()] = [
                        'company' => $program->getOrg()->getName(),
                        'logo' => $program->getOrg()->getLogo() ? '/'.Organization::UPLOAD_PATH.'/'.$program->getOrg()->getLogo() : '/img/avatar.png',
                        'jobTitle' => $append['program']
                    ];
                } else {
                    $result[$program->getOrg()->getId()] = [
                        'company' => $program->getOrg()->getName(),
                        'logo' =>  $program->getOrg()->getLogo() ? '/'.Organization::UPLOAD_PATH.'/'.$program->getOrg()->getLogo() : '/img/avatar.png',
                        'program' => [
                            [
                                'name' => $program->getName(),
                                'competencies' => $programService->getCompetencyProgram($program)
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
