<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use Exception;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(ProgramService $programService, Organization $org)
    {
        $page = request()->get('page');
        $data = $programService->paginateProgram(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.program.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            return url(route('administrator.program.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            return url(route('administrator.program.delete', [$org->getId(), $id]));
        };

        return view('program.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, ProgramService $programService, OrgService $orgService, Organization $org)
    {
        if ($request->method() == 'POST') {
            $request->merge(['org' => $org]);
            $request->validate([
                'org' => 'required',
                'name' => 'required',
                'degree' => 'required|in:'.StudyProgram::DEGREE_D1.','.StudyProgram::DEGREE_D2.','.StudyProgram::DEGREE_D3.','.StudyProgram::DEGREE_S1.','.StudyProgram::DEGREE_S2,
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

            return redirect()->route('administrator.program.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('program.create');
    }

    public function update(Request $request, ProgramService $programService, OrgService $orgService, Organization $org, StudyProgram $data)
    {
        if ($request->method() == 'POST') {
            $request->merge(['org' => $org]);
            $request->validate([
                'org' => 'required',
                'name' => 'required',
                'degree' => 'required|in:'.StudyProgram::DEGREE_D1.','.StudyProgram::DEGREE_D2.','.StudyProgram::DEGREE_D3.','.StudyProgram::DEGREE_S1.','.StudyProgram::DEGREE_S2,
            ]);

            try {
                $programService->update($data, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.study_program'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.study_program'))]);
            }

            return redirect()->route('administrator.program.index', ['org' => $org->getId()])->with($alert, $message);
        }

        return view('program.update', compact('data'));
    }

    public function delete(ProgramService $programService, Organization $org, StudyProgram $data)
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

        return redirect()->route('administrator.program.index', ['org' => $org->getId()])->with($alert, $message);
    }
}
