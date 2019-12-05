<?php

namespace App\Http\Controllers\Shared;

use App\Entities\CompetencyMainFunction;
use App\Http\Controllers\Controller;
use App\Services\Domain\CompetencyMainFunctionService;
use Exception;
use Illuminate\Http\Request;

class CompetencyMainFunctionController extends Controller
{
    public function index(CompetencyMainFunctionService $cmfService)
    {
        $page = request()->get('page');
        $data = $cmfService->paginateCMF(request()->get('page'));

        return view('cmf.index', compact('data', 'page'));
    }

    public function create(Request $request, CompetencyMainFunctionService $cmfService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.main_function'))
            ]);

            try {
                $cmfService->create(collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.competency_main_function'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.competency_main_function'))]);
            }

            return redirect()->route('shared.competencyMainFunction.index')->with($alert, $message);
        }

        return view('cmf.create');
    }

    public function update(Request $request, CompetencyMainFunctionService $cmfService, CompetencyMainFunction $cmf)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.main_function'))
            ]);

            try {
                $cmfService->update($cmf, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.competency_main_function'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.competency_main_function'))]);
            }

            return redirect()->route('shared.competencyMainFunction.index')->with($alert, $message);
        }

        return view('cmf.update', compact('cmf'));
    }

    public function delete(CompetencyMainFunctionService $cmfService, CompetencyMainFunction $cmf)
    {
        try {
            $cmfService->delete($cmf);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.competency_main_function'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.competency_main_function'))]);
        }

        return redirect()->route('shared.competencyMainFunction.index')->with($alert, $message);
    }
}
