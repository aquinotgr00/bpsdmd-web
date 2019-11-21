<?php

namespace App\Http\Controllers\Demand;

use App\Entities\JobTitle;
use App\Http\Controllers\Controller;
use App\Services\Domain\JobTitleService;
use App\Services\Domain\JobFunctionService;
use App\Services\Domain\LicenseService;
use Exception;
use Illuminate\Http\Request;

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

    public function create(Request $request, JobTitleService $jobTitleService, LicenseService $licenseService, JobFunctionService $jobFunctionService)
    {
        $licenses       = $licenseService->getAsList($request->input('license', []));
        $arrayLicenses  = $licenseService->getAsArray();
        $functions      = $jobFunctionService->getAsList($request->input('function', []));

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

                if(!$request->get('job_function') && $request->get('license')){
                    $jobFunction = $jobFunctionService->getRepository()->findOneBy(['name' => 'undefined']);
                    if(!$jobFunction){
                        $data = collect(['code' => '1', 'name' => 'undefined']);
                        $jobFunctionService->create($data, $org);
                        $jobFunction = $jobFunctionService->getRepository()->findOneBy(['name' => 'undefined']);
                    }
                    $requestData['job_function'] = [0=>$jobFunction->getId()];
                }else{
                    $requestData['job_function'] = $request->get('job_function');
                }

                $jobTitleService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.job_title'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.job_title'))]);
            }

            return redirect()->route('demand.jobTitle.index')->with($alert, $message);
        }

        return view('jobTitle.create', compact('licenses', 'functions', 'arrayLicenses'));
    }

    public function update(Request $request, JobTitleService $jobTitleService, LicenseService $licenseService, JobFunctionService $jobFunctionService, JobTitle $data)
    {
        $licenses       = $licenseService->getAsList($request->input('license', []));
        $arrayLicenses  = $licenseService->getAsArray();
        $functions      = $jobFunctionService->getAsList($data->getJobTitleFunction());

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

                if(!$request->get('job_function') && $request->get('license')){
                    $jobFunction = $jobFunctionService->getRepository()->findOneBy(['name' => 'undefined']);
                    if(!$jobFunction){
                        $data = collect(['code' => '1', 'name' => 'undefined']);
                        $jobFunctionService->create($data, $org);
                        $jobFunction = $jobFunctionService->getRepository()->findOneBy(['name' => 'undefined']);
                    }
                    $requestData['job_function'] = [0=>$jobFunction->getId()];
                }else{
                    $requestData['job_function'] = $request->get('job_function');
                }

                $jobTitleService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.job_title'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.job_title'))]);
            }

            return redirect()->route('demand.jobTitle.index')->with($alert, $message);
        }

        return view('jobTitle.update', compact('data', 'licenses', 'functions', 'arrayLicenses'));
    }

    public function delete(JobTitleService $jobTitleService, JobTitle $data)
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

        return redirect()->route('demand.jobTitle.index')->with($alert, $message);
    }
}
