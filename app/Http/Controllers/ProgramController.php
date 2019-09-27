<?php

namespace App\Http\Controllers;

use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\OrgDeleteException;

class ProgramController extends Controller
{
    public function index(OrgService $orgService)
    {
        $page = request()->get('page');
        $data = $orgService->paginateorg(request()->get('page'));

        return view('prodi.index', compact('data', 'page'));
    }

    public function detail(OrgService $orgService, Organization $data)
    {
        $page = request()->get('page');
        $data = $orgService->paginateorg(request()->get('page'));

        return view('prodi.detail', compact('data', 'page'));
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
                $message = 'Instansi berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah instansi. Silakan kontak web administrator!';
            }

            return redirect()->route('prodi.index')->with($alert, $message);
        }

        return view('prodi.create');
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
                $message = 'Instansi berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah instansi. Silakan kontak web administrator!';
            }

            return redirect()->route('prodi.index')->with($alert, $message);
        }

        return view('prodi.update', compact('data'));
    }

    public function delete(OrgService $orgService, Organization $data)
    {
        try {
            $orgService->delete($data);
            $alert = 'alert_success';
            $message = 'Instansi berhasil dihapus.';
        } catch (OrgDeleteException $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus instansi karena masih terdapat user instansi!';
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus instansi. Silakan kontak web administrator!';
        }

        return redirect()->route('prodi.index')->with($alert, $message);
    }
}
