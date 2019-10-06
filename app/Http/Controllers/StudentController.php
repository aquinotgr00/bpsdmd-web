<?php

namespace App\Http\Controllers;

use App\Entities\Student;
use App\Entities\Organization;
use App\Imports\StudentImport;
use App\Services\Domain\StudentService;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use App\Services\Domain\FeederService;
use App\Services\Application\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Exceptions\StudentDeleteException;
use Maatwebsite\Excel\Facades\Excel;
use Image;

class StudentController extends Controller
{
    public function index(StudentService $studentService)
    {
        $page = request()->get('page');
        $data = $studentService->paginateStudent(request()->get('page'));

        return view('student.index', compact('data', 'page'));
    }

    public function create(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'org' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('student.create')->withErrors($messageBag);
            }

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

            return redirect()->route('student.index')->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getRepository()->findAll();

        return view('student.create', ['dataOrg' => $dataOrg, 'dataStudyProgram' => $dataStudyProgram]);
    }

    public function update(Request $request, StudentService $studentService, Student $data, OrgService $orgService, ProgramService $programService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'org' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y'
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('student.update', ['id' => $data->getId()])->withErrors($messageBag);
            }

            $studyProgram = false;
            if ($request->get('studyProgram')) {
                $studyProgram = $programService->findById($request->get('studyProgram'));
            }

            try {
                $requestData = $request->all();

                $studentService->update($data, collect($requestData), $org, $studyProgram, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.student'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.student'))]);
            }

            return redirect()->route('student.index')->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getRepository()->findAll();

        return view('student.update', compact('data', 'dataOrg', 'dataStudyProgram'));
    }

    public function delete(StudentService $studentService, Student $data)
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

        return redirect()->route('student.index')->with($alert, $message);
    }

    public function upload(Request $request, FeederService $feederService, AuthService $authService)
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

        return redirect()->route('student.index')->with($alert, $message);
    }

    public function ajaxDetailStudent(Request $request, Student $data)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'study_program' => ($data->getStudyProgram() instanceof StudyProgram) ? $data->getStudyProgram()->getName() : '-',
                'period' => $data->getPeriod() ? $data->getPeriod() : '-',
                'curriculum' => $data->getCurriculum() ? $data->getCurriculum() : '-',
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'status' => $data->getStatus() ? $data->getStatus() : '-',
                'class' => $data->getClass() ? $data->getClass() : '-',
                'ipk' => $data->getIpk() ? $data->getIpk() : '-',
                'graduation_year' => $data->getGraduationYear() ? $data->getGraduationYear() : '-'
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
