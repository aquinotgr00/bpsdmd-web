<?php

namespace App\Http\Controllers\Demand;

use App\Entities\JobTitle;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\JobTitleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class JobTitleController extends Controller
{
    public function index(JobTitleService $jobTitleService)
    {
        $page = request()->get('page');
        $data = $jobTitleService->paginateJobTitle(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate = url(route('demand.jobTitle.create'));
        $urlUpdate = function($id) {
            return url(route('demand.jobTitle.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('demand.jobTitle.delete', [$id]));
        };

        return view('jobTitle.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, JobTitleService $jobTitleService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
            ]);

            $org = currentUser()->getOrg();
            try {
                $requestData = $request->all();

                $jobTitleService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.jobTitle'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.jobTitle'))]);
            }

            return redirect()->route('demand.jobTitle.index')->with($alert, $message);
        }

        return view('jobTitle.create');
    }

    public function update(Request $request, JobTitleService $jobTitleService, JobTitle $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $jobTitleService->update($data, collect($requestData), false, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.jobTitle'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.jobTitle'))]);
            }

            return redirect()->route('demand.jobTitle.index')->with($alert, $message);
        }

        return view('jobTitle.update', compact('data'));
    }

    public function delete(JobTitleService $jobTitleService, JobTitle $data)
    {
        try {
            $jobTitleService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.jobTitle'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.jobTitle'))]);
        }

        return redirect()->route('demand.jobTitle.index')->with($alert, $message);
    }
}