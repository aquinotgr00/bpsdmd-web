<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Diklat;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\DiklatService;
use App\Services\Domain\OrgService;
use App\Services\Domain\FeederService;
use App\Imports\DiklatImport;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\DiklatDeleteException;
use Image;
use Maatwebsite\Excel\Facades\Excel;

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

    public function upload(Request $request, FeederService $feederService, AuthService $authService)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = 'fd_'.$authService->user()->getOrg()->getId().'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $idFeeder = $feederService->create(collect($dataFeeder))->getId();

            $importer = new DiklatImport;

            Excel::import($importer, public_path('/excel/'.$nama_file));

            //update status feeder
            $feeder = $feederService->findById($idFeeder);
            $feederService->activeFeeder($feeder);

            $alert = 'alert_success';
            $message = trans('common.feeder_success', ['object' => trans('common.diklat')]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.feeder_failed', ['object' => trans('common.diklat')]);
        }

        return redirect()->route('supply.diklat.index')->with($alert, $message);
    }
}
