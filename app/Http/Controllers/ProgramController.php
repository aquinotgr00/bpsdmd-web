<?php

namespace App\Http\Controllers;

use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class ProgramController extends Controller
{
    public function index(ProgramService $programService, $org)
    {
        $page = request()->get('page');
        $data = $programService->paginateProgram(request()->get('page'), $org);

        return view('program.index', compact('data', 'page', 'org'));
    }

    public function create(Request $request, ProgramService $programService, OrgService $orgService, $org)
    {
        if ($request->method() == 'POST') {
            $request->merge(['org' => $orgService->findById($org)]);
            $request->validate([
                'org' => 'required',
            ]);

            try {
                $requestData = $request->all();
                $programService->create(collect($requestData));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.study_program'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.study_program'))]);
            }

            return redirect()->route('program.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('program.create');
    }

    public function update(Request $request, ProgramService $programService, OrgService $orgService, $org, StudyProgram $data)
    {
        if ($request->method() == 'POST') {
            $request->merge(['org' => $orgService->findById($org)]);
            $request->validate([
                'org' => 'required',
            ]);

            try {
                $requestData = $request->all();
                $programService->update($data, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.study_program'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.study_program'))]);
            }

            return redirect()->route('program.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('program.update', compact('data'));
    }

    public function delete(ProgramService $programService, $org, StudyProgram $data)
    {
        try {
            $programService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.study_program'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.study_program'))]);
        }

        return redirect()->route('program.index', ['org' => $org->getId()])->with($alert, $message);
    }
}
