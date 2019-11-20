<?php

namespace App\Http\Controllers\Supply;

use App\Entities\Teacher;
use App\Entities\Organization;
use App\Imports\TeacherImport;
use App\Http\Controllers\Controller;
use App\Services\Domain\TeacherService;
use App\Services\Domain\OrgService;
use App\Services\Domain\FeederService;
use App\Services\Application\AuthService;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Image;

class TeacherController extends Controller
{
    public function index(TeacherService $teacherService)
    {
        $page = request()->get('page');
        $data = $teacherService->paginateTeacher(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate   = url(route('supply.teacher.create'));
        $urlUpdate   = function($id) {
            return url(route('supply.teacher.update', [$id]));
        };
        $urlDelete   = function($id) {
            return url(route('supply.teacher.delete', [$id]));
        };
        $urlDetail   = '/teacher';
        $urlTemplate = url(route('supply.teacher.template.download'));
        $urlUpload   = url(route('supply.teacher.upload'));

        return view('teacher.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlTemplate', 'urlUpload'));
    }

    public function create(Request $request, TeacherService $teacherService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $org = currentUser()->getOrg();

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Teacher::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $teacherService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.teacher'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.teacher'))]);
            }

            return redirect()->route('supply.teacher.index')->with($alert, $message);
        }

        $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('teacher.create', ['dataOrg' => $dataOrg]);
    }

    public function update(Request $request, TeacherService $teacherService, Teacher $data, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Teacher::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $teacherService->update($data, collect($requestData), false, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.teacher'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.teacher'))]);
            }

            return redirect()->route('supply.teacher.index')->with($alert, $message);
        }

        $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('teacher.update', compact('data', 'dataOrg'));
    }

    public function delete(TeacherService $teacherService, Teacher $data)
    {
        try {
            $teacherService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.teacher'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.teacher'))]);
        }

        return redirect()->route('supply.teacher.index')->with($alert, $message);
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

            $importer = new TeacherImport;
            $importer->setOrg(currentUser()->getOrg());

            Excel::import($importer, public_path('/excel/'.$nama_file));

            //update status feeder
            $feeder = $feederService->findById($idFeeder);
            $feederService->activeFeeder($feeder);

            $alert = 'alert_success';
            $message = trans('common.feeder_success', ['object' => trans('common.teacher')]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.feeder_failed', ['object' => trans('common.teacher')]);
        }

        return redirect()->route('supply.teacher.index')->with($alert, $message);
    }

    public function ajaxDetailTeacher(Request $request, Teacher $data)
    {
        if ($request->ajax()) {
            $data = [
                'nip' => $data->getNip() ? $data->getNip() : '-',
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'front_degree' => $data->getFrontDegree() ? $data->getFrontDegree() : '-',
                'back_degree' => $data->getBackDegree() ? $data->getBackDegree() : '-',
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'nidn' => $data->getNidn() ? $data->getNidn() : '-',
                'photo' => $data->getPhoto() ? url(url(Teacher::UPLOAD_PATH.'/'.$data->getPhoto())) : url('img/avatar.png'),
            ];

            return response()->json($data);
        }

        return abort(404);
    }

    public function templateDownload()
    {
        $file = public_path(). "/download/template-dosen.xlsx";
        return response()->download($file, 'template.xlsx');
    }
}
