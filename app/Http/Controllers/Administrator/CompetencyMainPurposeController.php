<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\CompetencyMainPurpose;
use App\Http\Controllers\Controller;
use App\Services\Domain\CompetencyMainPurposeService;
use Exception;
use Illuminate\Http\Request;

class CompetencyMainPurposeController extends Controller
{
    public function index(CompetencyMainPurposeService $cmpService)
    {
        $page = request()->get('page');
        $data = $cmpService->paginateCMP(request()->get('page'));

        return view('cmp.index', compact('data', 'page'));
    }

    public function create(Request $request, CompetencyMainPurposeService $cmpService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.main_purpose'))
            ]);

            try {
                $cmpService->create(collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.competency_main_purpose'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.competency_main_purpose'))]);
            }

            return redirect()->route('administrator.competencyMainPurpose.index')->with($alert, $message);
        }

        return view('cmp.create');
    }

    public function update(Request $request, CompetencyMainPurposeService $cmpService, CompetencyMainPurpose $cmp)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.main_purpose'))
            ]);

            try {
                $cmpService->update($cmp, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.competency_main_purpose'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.competency_main_purpose'))]);
            }

            return redirect()->route('administrator.competencyMainPurpose.index')->with($alert, $message);
        }

        return view('cmp.update', compact('cmp'));
    }

    public function delete(CompetencyMainPurposeService $cmpService, CompetencyMainPurpose $cmp)
    {
        try {
            $cmpService->delete($cmp);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.competency_main_purpose'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.competency_main_purpose'))]);
        }

        return redirect()->route('administrator.competencyMainPurpose.index')->with($alert, $message);
    }
}
