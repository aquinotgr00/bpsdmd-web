<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Student;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Services\Application\AuthService;
use App\Services\Domain\FeederService;
use App\Services\Domain\StudentService;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(StudentService $studentService, Organization $org)
    {
        $page = request()->get('page');
        $data = $studentService->paginateStudent(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.student.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            url(route('administrator.student.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            url(route('administrator.student.delete', [$org->getId(), $id]));
        };
        $urlDetail = '/org/'.$org->getId().'/student';
        $urlUpload = url(route('administrator.student.upload', [$org->getId()]));

        return view('student.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService, Organization $org)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'org' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
            ]);

            $studyProgram = false;
            if ($request->get('studyProgram')) {
                $studyProgram = $programService->findById($request->get('studyProgram'));
            }

            try {
                $requestData = $request->all();

                $studentService->create(collect($requestData), $org, $studyProgram);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.student'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.student'))]);
            }

            return redirect()->route('administrator.student.index', ['org' => $org->getId()])->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getRepository()->findAll();

        return view('student.create', ['dataOrg' => $dataOrg, 'dataStudyProgram' => $dataStudyProgram]);
    }

    public function update(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService, Organization $org, Student $data)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'org' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y'
            ]);

            $studyProgram = false;
            if ($request->get('studyProgram')) {
                $studyProgram = $programService->findById($request->get('studyProgram'));
            }

            try {
                $requestData = $request->all();

                $studentService->update($data, collect($requestData), false, $studyProgram, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.student'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.student'))]);
            }

            return redirect()->route('administrator.student.index', ['org' => $org->getId()])->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getRepository()->findAll();

        return view('student.update', compact('data', 'dataOrg', 'dataStudyProgram'));
    }

    public function delete(StudentService $studentService, Organization $org, Student $data)
    {
        try {
            $studentService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.student'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.student'))]);
        }

        return redirect()->route('administrator.student.index', ['org' => $org->getId()])->with($alert, $message);
    }

    public function upload(Request $request, FeederService $feederService, AuthService $authService, Organization $org)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = 'fs_'.$authService->user()->getOrg()->getId().'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $idFeeder = $feederService->create(collect($dataFeeder))->getId();

            Excel::import(new StudentImport, public_path('/excel/'.$nama_file));

            //update status feeder
            $feeder = $feederService->findById($idFeeder);
            $feederService->activeFeeder($feeder);

            $alert = 'alert_success';
            $message = trans('common.feeder_success', ['object' => trans('common.student')]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.feeder_failed', ['object' => trans('common.student')]);
        }

        return redirect()->route('administrator.student.index', ['org' => $org->getId()])->with($alert, $message);
    }

    public function ajaxDetailStudent(Request $request, Organization $org, Student $data)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'study_program' => ($data->getStudyProgram() instanceof StudyProgram) ? $data->getStudyProgram()->getName() : '-',
                'period' => $data->getPeriod() ? $data->getPeriod() : '-',
                'curriculum' => $data->getCurriculum() ? $data->getCurriculum() : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'class' => $data->getClass() ? $data->getClass() : '-',
                'ipk' => $data->getIpk() ? $data->getIpk() : '-'
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
