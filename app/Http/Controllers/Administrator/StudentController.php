<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
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
use Image;

class StudentController extends Controller
{
    public function index(StudentService $studentService, Organization $org)
    {
        $page = request()->get('page');
        $data = $studentService->paginateStudent(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.student.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            return url(route('administrator.student.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            return url(route('administrator.student.delete', [$org->getId(), $id]));
        };
        $urlDetail = '/org/'.$org->getId().'/student';
        $urlUpload = url(route('administrator.student.upload', [$org->getId()]));

        return view('student.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService, Organization $org)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'nim' => 'required',
                'foreign_citizen' => 'required',
                'social_protection_card' => 'required',
                'start_semester' => 'required|numeric',
                'current_semester' => 'required|numeric',
                'student_credits' => 'required|numeric',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'gender' => 'in:' . Student::GENDER_MALE . ',' . Student::GENDER_FEMALE,
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'nim' => strtoupper(trans('common.nim')),
                'foreign_citizen' => ucfirst(trans('common.foreign_citizen')),
                'social_protection_card' => ucfirst(trans('common.social_protection_card')),
                'start_semester' => ucfirst(trans('common.start_semester')),
                'current_semester' => ucfirst(trans('common.current_semester')),
                'student_credits' => ucfirst(trans('common.student_credits')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'gender' => ucfirst(trans('common.gender')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $studyProgram = false;
            if ($request->get('studyProgram')) {
                $studyProgram = $programService->findById($request->get('studyProgram'));
            }

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Student::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

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
        $dataStudyProgram   = $programService->getProgramByOrg($org);

        return view('student.create', ['dataOrg' => $dataOrg, 'dataStudyProgram' => $dataStudyProgram]);
    }

    public function update(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService, Organization $org, Student $data)
    {
        if($org->getId() != $data->getOrg()->getId()){
            return abort(404);
        }
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'nim' => 'required',
                'foreign_citizen' => 'required',
                'social_protection_card' => 'required',
                'start_semester' => 'required|numeric',
                'current_semester' => 'required|numeric',
                'student_credits' => 'required|numeric',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'gender' => 'in:' . Student::GENDER_MALE . ',' . Student::GENDER_FEMALE,
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'nim' => strtoupper(trans('common.nim')),
                'foreign_citizen' => ucfirst(trans('common.foreign_citizen')),
                'social_protection_card' => ucfirst(trans('common.social_protection_card')),
                'start_semester' => ucfirst(trans('common.start_semester')),
                'current_semester' => ucfirst(trans('common.current_semester')),
                'student_credits' => ucfirst(trans('common.student_credits')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'gender' => ucfirst(trans('common.gender')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $studyProgram = false;
            if ($request->get('studyProgram')) {
                $studyProgram = $programService->findById($request->get('studyProgram'));
            }

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Student::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $studentService->update($data, collect($requestData), $org, $studyProgram, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.student'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.student'))]);
            }

            return redirect()->route('administrator.student.index', ['org' => $org->getId()])->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getProgramByOrg($org);

        return view('student.update', compact('data', 'dataOrg', 'dataStudyProgram'));
    }

    public function delete(StudentService $studentService, Organization $org, Student $data)
    {
        if($org->getId() != $data->getOrg()->getId()){
            return abort(404);
        }
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
        $nama_file = 'fs_'.$org->getId().'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $idFeeder = $feederService->create(collect($dataFeeder))->getId();

            $importer = new StudentImport;
            $importer->setOrg($org);

            Excel::import($importer, public_path('/excel/'.$nama_file));

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
        if($org->getId() != $data->getOrg()->getId()){
            return abort(404);
        }
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'study_program' => ($data->getStudyProgram() instanceof StudyProgram) ? $data->getStudyProgram()->getName() : '-',
                'period' => $data->getPeriod() ? $data->getPeriod() : '-',
                'curriculum' => $data->getCurriculum() ? $data->getCurriculum() : '-',
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'gender' => $data->getGender() ? ucfirst($data->getGender()) : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'status' => $data->getStatus() ? $data->getStatus() : '-',
                'class' => $data->getClass() ? $data->getClass() : '-',
                'ipk' => $data->getIpk() ? $data->getIpk() : '-',
                'graduation_year' => $data->getGraduationYear() ? $data->getGraduationYear() : '-',
                'photo' => $data->getPhoto() ? url(url(Student::UPLOAD_PATH.'/'.$data->getPhoto())) : url('img/avatar.png'),
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
