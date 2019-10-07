<?php

namespace App\Http\Controllers\Supply;

use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use Exception;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(ProgramService $programService)
    {
        $page = request()->get('page');
        $data = $programService->paginateProgram(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate = url(route('supply.program.create'));
        $urlUpdate = function($id) {
            url(route('supply.program.update', [$id]));
        };
        $urlDelete = function($id) {
            url(route('supply.program.delete', [$id]));
        };

        return view('program.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, ProgramService $programService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->merge(['org' => currentUser()->getOrg()]);
            $request->validate([
                'org' => 'required',
            ]);

            try {
                $programService->create(collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.study_program'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.study_program'))]);
            }

            return redirect()->route('supply.program.index')->with($alert, $message);
        }

        return view('program.create');
    }

    public function update(Request $request, ProgramService $programService, OrgService $orgService, StudyProgram $data)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'org' => 'required',
            ]);

            try {
                $programService->update($data, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.study_program'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.study_program'))]);
            }

            return redirect()->route('supply.program.index')->with($alert, $message);
        }

        return view('program.update', compact('data'));
    }

    public function delete(ProgramService $programService, StudyProgram $data)
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

        return redirect()->route('supply.program.index')->with($alert, $message);
    }
}
