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
use App\Services\Domain\LicenseService;
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

                    $append['jobTitle'][$jobTitle->getId()] = [
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
                            $jobTitle->getId() => [
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

    public function selectSupply(OrgService $orgService) {
        $page = request()->get('page');
        $data = $orgService->paginateOrgSupply(request()->get('page'));

        return view('linkMatch.selectSupply', compact('data', 'page'));
    }

    public function selectProgram(ProgramService $programService, Organization $org) {
        $page = request()->get('page');
        $data = $programService->paginateProgram(request()->get('page'), $org);

        return view('linkMatch.selectProgram', compact('data', 'page', 'org'));
    }

    public function updateData(Request $request, LinkMatchService $linkMatchService, LicenseService $licenseService, OrgService $orgService, JobTitleService $jobTitleService, Organization $org, StudyProgram $program) {
        $selectedLicense = [];
        $selectedLicenseIds = [];

        if ($request->method() == 'POST') {
            $linkMatchService->massUpdate($program, $request->get('license', []), $request->get('job_title', []), $request->get('deleted_job_title', []));

            $alert = 'alert_success';
            $message = trans('common.update_success', ['object' => 'Link and Match']);

            return redirect()->route('administrator.link-match.update', [$org->getId(), $program->getId()])->with($alert, $message);
        }

        /** @var LicenseStudyProgram $licenseStudyProgram */
        foreach ($program->getLicenseStudyProgram() as $licenseStudyProgram) {
            $selectedLicense[] = $licenseStudyProgram->getLicense();
            $selectedLicenseIds[] = $licenseStudyProgram->getLicense()->getId();
        }

        $licenses = $licenseService->getAsList($selectedLicenseIds);
        $demands = $orgService->getDemandAsList($org->getModa());
        $jobTitles = $jobTitleService->getJobTitleByLicenses($org->getModa(), $selectedLicenseIds);

        return view('linkMatch.updateData', compact('org', 'program', 'selectedLicense', 'licenses', 'demands', 'jobTitles'));
    }

    public function ajaxListJobTitle(Request $request, JobTitleService $jobTitleService, Organization $organization)
    {
        if ($request->ajax()) {
            $jobTitles = $jobTitleService->getByOrganization($organization);

            return response()->json($jobTitles);
        }

        return abort(404);
    }
}
