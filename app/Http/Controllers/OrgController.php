<?php

namespace App\Http\Controllers;

use App\Entities\Organization;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\OrgDeleteException;
use Image;

class OrgController extends Controller
{
    public function index(OrgService $orgService)
    {
        $page = request()->get('page');
        $data = $orgService->paginateOrg(request()->get('page'));

        return view('org.index', compact('data', 'page'));
    }

    public function create(Request $request, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'short_name' => 'required',
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND,
                'moda' => 'in:' . Organization::MODA_AIR . ',' . Organization::MODA_UDARA . ',' . Organization::MODA_DARAT,
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ]);

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Organization::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $orgService->create(collect($requestData));
                $alert = 'alert_success';
                $message = 'Instansi berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah instansi. Silakan kontak web administrator!';
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
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND,
                'moda' => 'in:' . Organization::MODA_AIR . ',' . Organization::MODA_UDARA . ',' . Organization::MODA_DARAT,
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ]);

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Organization::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $orgService->update($data, collect($requestData), true);
                $alert = 'alert_success';
                $message = 'Instansi berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah instansi. Silakan kontak web administrator!';
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

        return redirect()->route('org.index')->with($alert, $message);
    }

    public function ajaxDetailOrg(Request $request, Organization $org)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $org->getCode(),
                'name' => $org->getName(),
                'short_name' => $org->getShortName(),
                'photo' => $org->getPhoto() ? url(url(Organization::UPLOAD_PATH.'/'.$org->getPhoto())) : url('img/avatar.png'),
                'type' => $org->getType(),
                'moda' => $org->getModa(),
                'address' => $org->getAddress()
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
