<?php

namespace App\Http\Controllers;

use App\Entities\Organization;
use App\Services\Domain\OrgService;
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
                'type' => 'required|in:'.Organization::TYPE_SUPPLY.','.Organization::TYPE_DEMAND
            ]);

            try {
                $orgService->create(collect($request->input()));
                $message = 'Instansi berhasil ditambahkan.';
            } catch (\Exception $e) {
                report($e);
                $message = 'Tidak dapat menambah instansi. Silakan kontak web administrator!';
            }

            return redirect()->route('org.index')->with('alert', $message);
        }

        return view('org.create');
    }

    public function update(Request $request, OrgService $orgService, Organization $data)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'type' => 'required|in:'.Organization::TYPE_SUPPLY.','.Organization::TYPE_DEMAND
            ]);

            try {
                $orgService->update($data, collect($request->input()));
                $message = 'Instansi berhasil diubah.';
            } catch (\Exception $e) {
                $message = 'Tidak dapat mengubah instansi. Silakan kontak web administrator!';
            }

            return redirect()->route('org.index')->with('alert', $message);
        }

        return view('org.update', compact('data'));
    }

    public function delete(OrgService $orgService, Organization $data)
    {
        try {
            $orgService->delete($data);
            $message = 'Instansi berhasil dihapus.';
        } catch (OrgDeleteException $e) {
            report($e);
            $message = 'Tidak dapat menghapus instansi karena masih terdapat user instansi!';
        } catch (\Exception $e) {
            report($e);
            $message = 'Tidak dapat menghapus instansi. Silakan kontak web administrator!';
        }

        return redirect()->route('org.index')->with('alert', $message);
    }
}
