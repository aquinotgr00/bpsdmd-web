<?php

namespace App\Http\Controllers\Shared;

use App\Entities\CompetencyUnit;
use App\Http\Controllers\Controller;
use App\Services\Domain\CompetencyUnitService;
use Exception;
use Illuminate\Http\Request;

class CompetencyUnitController extends Controller
{
    public function index(CompetencyUnitService $cuService)
    {
        $page = request()->get('page');
        $data = $cuService->paginateCU(request()->get('page'));

        return view('cu.index', compact('data', 'page'));
    }

    public function create(Request $request, CompetencyUnitService $cuService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.unit'))
            ]);

            try {
                $cuService->create(collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.competency_unit'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.competency_unit'))]);
            }

            return redirect()->route('shared.competencyUnit.index')->with($alert, $message);
        }

        return view('cu.create');
    }

    public function update(Request $request, CompetencyUnitService $cuService, CompetencyUnit $cu)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'text' => 'required'
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'text' => ucfirst(trans('common.unit'))
            ]);

            try {
                $cuService->update($cu, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.competency_unit'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.competency_unit'))]);
            }

            return redirect()->route('shared.competencyUnit.index')->with($alert, $message);
        }

        return view('cu.update', compact('cu'));
    }

    public function delete(CompetencyUnitService $cuService, CompetencyUnit $cu)
    {
        try {
            $cuService->delete($cu);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.competency_unit'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.competency_unit'))]);
        }

        return redirect()->route('shared.competencyUnit.index')->with($alert, $message);
    }
}
