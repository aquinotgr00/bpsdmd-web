<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\JobFunction;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\JobFunctionService;
use Exception;
use Illuminate\Http\Request;

class JobFunctionController extends Controller
{
    public function index(JobFunctionService $jobFunctionService, Organization $org)
    {
        $page = request()->get('page');
        $data = $jobFunctionService->paginateJobFunction(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.jobFunction.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            return url(route('administrator.jobFunction.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            return url(route('administrator.jobFunction.delete', [$org->getId(), $id]));
        };

        return view('jobFunction.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, JobFunctionService $jobFunctionService, Organization $org)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'code' => 'required',
                'name' => 'required',
            ];

            $request->validate($validation, [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $jobFunctionService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.job_function'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.job_function'))]);
            }

            return redirect()->route('administrator.jobFunction.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('jobFunction.create');
    }

    public function update(Request $request, JobFunctionService $jobFunctionService, Organization $org, JobFunction $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'code' => 'required',
                'name' => 'required',
            ];

            $request->validate($validation, [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $jobFunctionService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.job_function'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.job_function'))]);
            }

            return redirect()->route('administrator.jobFunction.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('jobFunction.update', compact('data'));
    }

    public function delete(JobFunctionService $jobFunctionService, Organization $org, JobFunction $data)
    {
        try {
            $jobFunctionService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.job_function'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.job_function'))]);
        }

        return redirect()->route('administrator.jobFunction.index', ['org' => $org->getId()])->with($alert, $message);
    }
}
