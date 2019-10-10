<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\DataDiklat;
use App\Entities\Diklat;
use App\Http\Controllers\Controller;
use App\Services\Domain\DataDiklatService;
use App\Services\Domain\DiklatService;
use Exception;
use Illuminate\Http\Request;

class Data_diklatController extends Controller
{
    public function index(DataDiklatService $dataDiklatService, Diklat $diklat)
    {
        $page = request()->get('page');
        $data = $dataDiklatService->paginateDataDiklat(request()->get('page'), $diklat);

        //build urls
        $urlCreate = url(route('administrator.data_diklat.create', [$diklat->getId()]));
        $urlUpdate = function($id) use ($diklat) {
            return url(route('administrator.data_diklat.update', [$diklat->getId(), $id]));
        };
        $urlDelete = function($id) use ($diklat) {
            return url(route('administrator.data_diklat.delete', [$diklat->getId(), $id]));
        };

        return view('data_diklat.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, DataDiklatService $dataDiklatService, DiklatService $diklatService, Diklat $diklat)
    {
        if ($request->method() == 'POST') {
            $request->merge(['diklat' => $diklat]);
            $request->validate([
                'startDate' => 'required|date_format:"d-m-Y"',
                'endDate' => 'required|date_format:"d-m-Y"',
            ]);

            try {
                $requestData = $request->all();

                $dataDiklatService->create(collect($requestData));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.data_diklat'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.data_diklat'))]);
            }

            return redirect()->route('administrator.data_diklat.index', ['diklat' => $diklat->getId()])->with($alert, $message);
        }

        return view('data_diklat.create');
    }

    public function update(Request $request, DataDiklatService $dataDiklatService, DiklatService $diklatService, Diklat $diklat, DataDiklat $data)
    {
        // var_dump($data);exit;
        if ($request->method() == 'POST') {
            $request->merge(['diklat' => $diklat]);
            $request->validate([
                'startDate' => 'required|date_format:"d-m-Y"',
                'endDate' => 'required|date_format:"d-m-Y"',
            ]);

            try {
                $requestData = $request->all();

                $dataDiklatService->update($data, collect($requestData), true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.data_diklat'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.data_diklat'))]);
            }

            return redirect()->route('administrator.data_diklat.index', ['diklat' => $diklat->getId()])->with($alert, $message);
        }

        return view('data_diklat.update', compact('data'));
    }

    public function delete(DataDiklatService $dataDiklatService, Diklat $diklat, DataDiklat $data)
    {
        try {
            $dataDiklatService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.data_diklat'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.data_diklat'))]);
        }

        return redirect()->route('administrator.data_diklat.index', ['diklat' => $diklat->getId()])->with($alert, $message);
    }
}
