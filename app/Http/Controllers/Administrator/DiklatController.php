<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Diklat;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\DiklatService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\DiklatDeleteException;
use Image;

class DiklatController extends Controller
{
    public function index(DiklatService $diklatService)
    {
        $page = request()->get('page');
        $data = $diklatService->paginateDiklat(request()->get('page'));

        return view('diklat.index', compact('data', 'page'));
    }

    public function create(Request $request, DiklatService $diklatService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'type' => 'required|in:' . Diklat::TYPE_DPM . ',' . Diklat::TYPE_TEKNIS,
            ]);

            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }

            try {
                $requestData = $request->all();

                $diklatService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.diklat'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.diklat'))]);
            }

            return redirect()->route('administrator.diklat.index')->with($alert, $message);
        }
        $dataOrg    = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('diklat.create', ['dataOrg' => $dataOrg]);
    }

    public function update(Request $request, DiklatService $diklatService, OrgService $orgService, Diklat $data)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'type' => 'required|in:' . Diklat::TYPE_DPM . ',' . Diklat::TYPE_TEKNIS,
            ]);

            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }

            try {
                $requestData = $request->all();

                $diklatService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.diklat'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.diklat'))]);
            }

            return redirect()->route('administrator.diklat.index')->with($alert, $message);
        }
        $dataOrg    = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('diklat.update', compact('data', 'dataOrg'));
    }

    public function delete(DiklatService $diklatService, Diklat $data)
    {
        try {
            $diklatService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.diklat'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.diklat'))]);
        }

        return redirect()->route('administrator.diklat.index')->with($alert, $message);
    }

    public function ajaxDetailDiklat(Request $request, Organization $org, Diklat $data)
    {
        if ($request->ajax()) {
            $data = [
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'type' => $data->getType() ? $data->getType() : '-',
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
