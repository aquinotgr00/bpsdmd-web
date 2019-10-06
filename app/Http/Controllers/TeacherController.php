<?php

namespace App\Http\Controllers;

use App\Entities\Teacher;
use App\Entities\Organization;
use App\Imports\TeacherImport;
use App\Services\Domain\TeacherService;
use App\Services\Domain\OrgService;
use App\Services\Domain\FeederService;
use App\Services\Application\AuthService;
use App\Exceptions\TeacherDeleteException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Image;

class TeacherController extends Controller
{
    public function index(TeacherService $teacherService)
    {
        $page = request()->get('page');
        $data = $teacherService->paginateTeacher(request()->get('page'));

        return view('teacher.index', compact('data', 'page'));
    }

    public function create(Request $request, TeacherService $teacherService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('teacher.create')->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $teacherService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.teacher'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.teacher'))]);
            }

            return redirect()->route('teacher.index')->with($alert, $message);
        }

        $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('teacher.create', ['dataOrg' => $dataOrg]);
    }

    public function update(Request $request, TeacherService $teacherService, Teacher $data, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('teacher.update', ['id' => $data->getId()])->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $teacherService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.teacher'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.teacher'))]);
            }

            return redirect()->route('teacher.index')->with($alert, $message);
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

        return redirect()->route('teacher.index')->with($alert, $message);
    }

    public function upload(Request $request, FeederService $feederService, AuthService $authService)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = 'fs_'.$authService->user()->getOrg()->getId().'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);
        
        //insert feeder
        $feeder = ['filename' => $nama_file, 'user' => $authService->user()];
        $feederService->create(collect($feeder));

        Excel::import(new TeacherImport, public_path('/excel/'.$nama_file));

        $alert = 'alert_success';
        $message = 'Import Success';

        return redirect()->route('teacher.index')->with($alert, $message);
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
                'nidn' => $data->getNidn() ? $data->getNidn() : '-'
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
