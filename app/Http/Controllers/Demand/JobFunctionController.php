<?php

namespace App\Http\Controllers\Demand;

use App\Entities\JobFunction;
use App\Http\Controllers\Controller;
use App\Services\Domain\JobFunctionService;
use Exception;
use Illuminate\Http\Request;

class JobFunctionController extends Controller
{
    public function index(JobFunctionService $jobFunctionService)
    {
        $page = request()->get('page');
        $data = $jobFunctionService->paginateJobFunction(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate = url(route('demand.jobFunction.create'));
        $urlUpdate = function($id) {
            return url(route('demand.jobFunction.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('demand.jobFunction.delete', [$id]));
        };

        return view('jobFunction.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, JobFunctionService $jobFunctionService)
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

                $jobFunctionService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.job_function'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.job_function'))]);
            }

            return redirect()->route('demand.jobFunction.index')->with($alert, $message);
        }

        return view('jobFunction.create');
    }

    public function update(Request $request, JobFunctionService $jobFunctionService, JobFunction $data)
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

                $jobFunctionService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.job_function'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.job_function'))]);
            }

            return redirect()->route('demand.jobFunction.index')->with($alert, $message);
        }

        return view('jobFunction.update', compact('data'));
    }

    public function delete(JobFunctionService $jobFunctionService, JobFunction $data)
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

        return redirect()->route('demand.jobFunction.index')->with($alert, $message);
    }
}
