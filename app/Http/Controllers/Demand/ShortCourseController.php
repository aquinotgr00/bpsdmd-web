<?php

namespace App\Http\Controllers\Demand;

use App\Entities\ShortCourse;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\ShortCourseService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use App\Services\Domain\FeederService;
use App\Services\Application\AuthService;
use App\Imports\ShortCourseImport;
use App\Services\Domain\ShortCourseDataService;
use App\Services\Domain\ShortCourseParticipantService;

class ShortCourseController extends Controller
{
    public function index(ShortCourseService $shortCourseService, OrgService $orgService)
    {
        $page = request()->get('page');
        $data = $shortCourseService->paginateShortCourse(request()->get('page'));

        $orgs = $orgService->getRepository()->findAll();

        //build urls
        $urlCreate = url(route('demand.shortCourse.create'));
        $urlDetail = '/short-course';

        return view('shortCourse.indexdemand', compact('data', 'page', 'urlCreate', 'urlDetail', 'orgs'));
    }

    public function create(Request $request, ShortCourseService $shortCourseService, OrgService $orgService, ShortCourseDataService $shortCourseDataService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'type' => 'required|in:' . ShortCourse::TYPE_DPM . ',' . ShortCourse::TYPE_TEKNIS,
                'startDate' => 'required|date_format:"d-m-Y"',
                'endDate' => 'required|date_format:"d-m-Y"',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'type' => ucfirst(trans('common.type')),
                'startDate' => ucfirst(trans('common.start_date')),
                'endDate' => ucfirst(trans('common.end_date')),
            ]);

            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }

            try {
                $requestData = $request->all();

                $shortCourse = $shortCourseService->create(collect($requestData), $org);
                $shortCourseDataService->create(collect($requestData), $shortCourse);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.short_course'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.short_course'))]);
            }

            return redirect()->route('demand.shortCourse.index')->with($alert, $message);
        }
        $dataOrg    = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('shortCourse.createdemand', ['dataOrg' => $dataOrg]);
    }
}
