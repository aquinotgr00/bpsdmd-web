<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\JobTitle;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\JobTitleService;
use App\Services\Domain\JobFunctionService;
use App\Services\Domain\LicenseService;
use Exception;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    public function index(JobTitleService $jobTitleService, Organization $org)
    {
        $page = request()->get('page');
        $data = $jobTitleService->paginateJobTitle(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.jobTitle.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            return url(route('administrator.jobTitle.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            return url(route('administrator.jobTitle.delete', [$org->getId(), $id]));
        };

        return view('jobTitle.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, JobTitleService $jobTitleService, LicenseService $licenseService, JobFunctionService $jobFunctionService, Organization $org)
    {
        $licenses       = $licenseService->getAsList($request->input('license', []));
        $arrayLicenses  = $licenseService->getAsArray();
        $functions      = $jobFunctionService->getAsList($request->input('function', []));
        $arrayHeads     = $jobFunctionService->getHeadAsArray();

        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                // 'withJobFunction' => 'required'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $jobTitleService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.job_title'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.job_title'))]);
            }

            return redirect()->route('administrator.jobTitle.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('jobTitle.create', compact('licenses', 'functions', 'arrayLicenses', 'arrayHeads'));
    }

    public function update(Request $request, JobTitleService $jobTitleService, LicenseService $licenseService, JobFunctionService $jobFunctionService, Organization $org, JobTitle $data)
    {
        $licenses       = $licenseService->getAsList($request->input('license', []));
        $arrayLicenses  = $licenseService->getAsArray();
        $functions      = $jobFunctionService->getAsList($data->getJobTitleFunction());
        $arrayHeads     = $jobFunctionService->getHeadAsArray();

        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                // 'withJobFunction' => 'required'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $jobTitleService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.job_title'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.job_title'))]);
            }

            return redirect()->route('administrator.jobTitle.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('jobTitle.update', compact('data', 'licenses', 'functions', 'arrayLicenses', 'arrayHeads'));
    }

    public function delete(JobTitleService $jobTitleService, Organization $org, JobTitle $data)
    {
        try {
            $jobTitleService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.job_title'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.job_title'))]);
        }

        return redirect()->route('administrator.jobTitle.index', ['org' => $org->getId()])->with($alert, $message);
    }
}
