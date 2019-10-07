<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Organization;
use App\Http\Controllers\Controller;
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
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND,
                'moda' => 'required|in:' . Organization::MODA_LAUT . ',' . Organization::MODA_UDARA . ',' . Organization::MODA_DARAT . ',' . Organization::MODA_KERETA,
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
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.institute'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.institute'))]);
            }

            return redirect()->route('administrator.org.index')->with($alert, $message);
        }

        return view('org.create');
    }

    public function update(Request $request, OrgService $orgService, Organization $data)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND,
                'moda' => 'required|in:' . Organization::MODA_LAUT . ',' . Organization::MODA_UDARA . ',' . Organization::MODA_DARAT . ',' . Organization::MODA_KERETA,
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
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.institute'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.institute'))]);
            }

            return redirect()->route('administrator.org.index')->with($alert, $message);
        }

        return view('org.update', compact('data'));
    }

    public function delete(OrgService $orgService, Organization $data)
    {
        try {
            $orgService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.institute'))]);
        } catch (OrgDeleteException $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.institute'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.institute'))]);
        }

        return redirect()->route('administrator.org.index')->with($alert, $message);
    }

    public function ajaxDetailOrg(Request $request, Organization $org)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $org->getCode() ? $org->getCode() : '-',
                'name' => $org->getName(),
                'short_name' => $org->getShortName() ? $org->getShortName() : '-',
                'photo' => $org->getPhoto() ? url(url(Organization::UPLOAD_PATH.'/'.$org->getPhoto())) : url('img/avatar.png'),
                'type' => $org->getType(),
                'moda' => $org->getModa(),
                'address' => $org->getAddress() ? $org->getAddress() : '-'
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
