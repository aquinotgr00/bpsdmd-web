<?php

namespace App\Http\Controllers\Administrator;

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
use Maatwebsite\Excel\Facades\Excel;

class ShortCourseController extends Controller
{
    public function index(ShortCourseService $shortCourseService)
    {
        $page = request()->get('page');
        $data = $shortCourseService->paginateShortCourse(request()->get('page'));

        //build urls
        $urlCreate = url(route('administrator.shortCourse.create'));
        $urlUpdate = function($id) {
            return url(route('administrator.shortCourse.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('administrator.shortCourse.delete', [$id]));
        };
        $urlDetail = '/short-course';

        return view('shortCourse.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail'));
    }

    public function create(Request $request, ShortCourseService $shortCourseService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'type' => 'required|in:' . ShortCourse::TYPE_DPM . ',' . ShortCourse::TYPE_TEKNIS,
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'type' => ucfirst(trans('common.type')),
            ]);

            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }

            try {
                $requestData = $request->all();

                $shortCourseService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.short_course'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.short_course'))]);
            }

            return redirect()->route('administrator.shortCourse.index')->with($alert, $message);
        }
        $dataOrg    = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('shortCourse.create', ['dataOrg' => $dataOrg]);
    }

    public function update(Request $request, ShortCourseService $shortCourseService, OrgService $orgService, ShortCourse $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'type' => 'required|in:' . ShortCourse::TYPE_DPM . ',' . ShortCourse::TYPE_TEKNIS,
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'type' => ucfirst(trans('common.type')),
            ]);

            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }

            try {
                $requestData = $request->all();

                $shortCourseService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.short_course'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.short_course'))]);
            }

            return redirect()->route('administrator.shortCourse.index')->with($alert, $message);
        }
        $dataOrg    = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('shortCourse.update', compact('data', 'dataOrg'));
    }

    public function delete(ShortCourseService $shortCourseService, ShortCourse $data)
    {
        try {
            $shortCourseService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.short_course'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.short_course'))]);
        }

        return redirect()->route('administrator.shortCourse.index')->with($alert, $message);
    }

    public function ajaxDetailShortCourse(Request $request, Organization $org, ShortCourse $data)
    {
        if ($request->ajax()) {
            $data = [
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'type' => $data->getType() ? ucfirst($data->getType()) : '-',
            ];

            return response()->json($data);
        }

        return abort(404);
    }

    public function upload(Request $request, FeederService $feederService, AuthService $authService)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        if ($authService->user()->getEmail() === 'admin@bpsdm.com') {
            $orgId = 0;
        } else {
            $orgId = $authService->user()->getOrg()->getId();
        }
        $nama_file = 'fd_'.$orgId.'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $idFeeder = $feederService->create(collect($dataFeeder))->getId();

            $importer = new ShortCourseImport;

            Excel::import($importer, public_path('/excel/'.$nama_file));

            //update status feeder
            $feeder = $feederService->findById($idFeeder);
            $feederService->activeFeeder($feeder);

            $alert = 'alert_success';
            $message = trans('common.feeder_success', ['object' => trans('common.short_course')]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.feeder_failed', ['object' => trans('common.short_course')]);
        }

        return redirect()->route('administrator.shortCourse.index')->with($alert, $message);
    }

    public function templateDownload()
    {
        $file = public_path(). "/download/template-diklat.xlsx";
        return response()->download($file, 'template.xlsx');
    }
}
