<?php

namespace App\Http\Controllers;

use App\Entities\Organization;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\OrgDeleteException;

class OrgController extends Controller
{
    public function index(OrgService $orgService)
    {
        $page = request()->get('page');
        $data = $orgService->paginateorg(request()->get('page'));

        return view('org.index', compact('data', 'page'));
    }

    public function create(Request $request, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'short_name' => 'required',
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND
            ]);

            try {
                $orgService->create(collect($request->input()));
                $alert = 'alert_success';
                $message = 'Organisasi berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah organisasi. Silakan kontak web administrator!';
            }

            return redirect()->route('org.index')->with($alert, $message);
        }

        return view('org.create');
    }

    public function update(Request $request, OrgService $orgService, Organization $data)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'short_name' => 'required',
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND
            ]);

            try {
                $orgService->update($data, collect($request->input()));
                $alert = 'alert_success';
                $message = 'Organisasi berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah organisasi. Silakan kontak web administrator!';
            }

            return redirect()->route('org.index')->with($alert, $message);
        }

        return view('org.update', compact('data'));
    }

    public function delete(OrgService $orgService, Organization $data)
    {
        try {
            $orgService->delete($data);
            $alert = 'alert_success';
            $message = 'Organisasi berhasil dihapus.';
        } catch (OrgDeleteException $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus organisasi karena masih terdapat user organisasi!';
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus organisasi. Silakan kontak web administrator!';
        }

        return redirect()->route('org.index')->with($alert, $message);
    }
}
