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
            return url(route('supply.program.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('supply.program.delete', [$id]));
        };
        $urlDetail = '/program';

        return view('program.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail'));
    }

    public function create(Request $request, ProgramService $programService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'status' => 'required',
                'vision' => 'required',
                'mission' => 'required',
                'passing_grade_credits' => 'required',
                'degree' => 'required|in:'.StudyProgram::DEGREE_D1.','.StudyProgram::DEGREE_D2.','.StudyProgram::DEGREE_D3.','.StudyProgram::DEGREE_S1.','.StudyProgram::DEGREE_S2,
                'license' => 'array',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'status' => ucfirst(trans('common.status')),
                'vision' => ucfirst(trans('common.vision')),
                'mission' => ucfirst(trans('common.mission')),
                'passing_grade_credits' => ucfirst(trans('common.passing_grade_credits')),
                'degree' => ucfirst(trans('common.degree')),
                'license' => ucfirst(trans('common.license')),
            ]);

            $org = currentUser()->getOrg();

            try {
                $requestData = $request->all();

                $programService->create(collect($requestData), $request->input('license', []), $org);
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

    public function update(Request $request, ProgramService $programService, StudyProgram $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'status' => 'required',
                'vision' => 'required',
                'mission' => 'required',
                'passing_grade_credits' => 'required',
                'degree' => 'required|in:'.StudyProgram::DEGREE_D1.','.StudyProgram::DEGREE_D2.','.StudyProgram::DEGREE_D3.','.StudyProgram::DEGREE_S1.','.StudyProgram::DEGREE_S2,
                'license' => 'array',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'status' => ucfirst(trans('common.status')),
                'vision' => ucfirst(trans('common.vision')),
                'mission' => ucfirst(trans('common.mission')),
                'passing_grade_credits' => ucfirst(trans('common.passing_grade_credits')),
                'degree' => ucfirst(trans('common.degree')),
                'license' => ucfirst(trans('common.license')),
            ]);

            try {
                $requestData = $request->all();

                $programService->update($data, collect($requestData), false, true);
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

    public function ajaxDetailProgram(Request $request, Organization $org, StudyProgram $data)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'degree' => $data->getDegree() ? ucfirst($data->getDegree()) : '-',
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
