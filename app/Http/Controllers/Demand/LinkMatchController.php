<?php

namespace App\Http\Controllers\Demand;

use App\Entities\JobTitle;
use App\Entities\License;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Services\Application\LinkMatchService;
use App\Services\Domain\JobTitleService;
use App\Services\Domain\ProgramService;
use Illuminate\Http\Request;

class LinkMatchController extends Controller
{
    public function demand()
    {
        $jobTitles = currentUser()->getOrg()->getJobTitles();

        return view('linkMatch.demand-user', compact('jobTitles'));
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
