<?php

namespace App\Http\Controllers\Shared;

use App\Entities\CompetencyKeyFunction;
use App\Http\Controllers\Controller;
use App\Services\Domain\CompetencyKeyFunctionService;
use Exception;
use Illuminate\Http\Request;

class CompetencyKeyFunctionController extends Controller
{
    public function index(CompetencyKeyFunctionService $ckfService)
    {
        $page = request()->get('page');
        $data = $ckfService->paginateCKF(request()->get('page'));

        return view('ckf.index', compact('data', 'page'));
    }

    public function create(Request $request, CompetencyKeyFunctionService $ckfService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.key_function'))
            ]);

            try {
                $ckfService->create(collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.competency_key_function'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.competency_key_function'))]);
            }

            return redirect()->route('shared.competencyKeyFunction.index')->with($alert, $message);
        }

        return view('ckf.create');
    }

    public function update(Request $request, CompetencyKeyFunctionService $ckfService, CompetencyKeyFunction $ckf)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.key_function'))
            ]);

            try {
                $ckfService->update($ckf, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.competency_key_function'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.competency_key_function'))]);
            }

            return redirect()->route('shared.competencyKeyFunction.index')->with($alert, $message);
        }

        return view('ckf.update', compact('ckf'));
    }

    public function delete(CompetencyKeyFunctionService $ckfService, CompetencyKeyFunction $ckf)
    {
        try {
            $ckfService->delete($ckf);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.competency_key_function'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.competency_key_function'))]);
        }

        return redirect()->route('shared.competencyKeyFunction.index')->with($alert, $message);
    }
}
