<?php

namespace App\Http\Controllers\Supply;

use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Imports\StudentImport;
use App\Http\Controllers\Controller;
use App\Services\Domain\StudentService;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use App\Services\Domain\FeederService;
use App\Services\Application\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Image;

class StudentController extends Controller
{
    public function index(StudentService $studentService)
    {
        $page = request()->get('page');
        $data = $studentService->paginateStudent(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate = url(route('supply.student.create'));
        $urlUpdate = function($id) {
            return url(route('supply.student.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('supply.student.delete', [$id]));
        };
        $urlDetail = '/student';
        $urlUpload = url(route('supply.student.upload'));

        return view('student.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'gender' => 'in:' . Student::GENDER_MALE . ',' . Student::GENDER_FEMALE,
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'gender' => ucfirst(trans('common.gender')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $org = currentUser()->getOrg();

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

            return redirect()->route('supply.student.index')->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getProgramByOrg(currentUser()->getOrg());

        return view('student.create', ['dataOrg' => $dataOrg, 'dataStudyProgram' => $dataStudyProgram]);
    }

    public function update(Request $request, StudentService $studentService, Student $data, OrgService $orgService, ProgramService $programService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'gender' => 'in:' . Student::GENDER_MALE . ',' . Student::GENDER_FEMALE,
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
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

                $studentService->update($data, collect($requestData), false, $studyProgram, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.student'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.student'))]);
            }

            return redirect()->route('supply.student.index')->with($alert, $message);
        }

        $dataOrg            = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataStudyProgram   = $programService->getProgramByOrg(currentUser()->getOrg());

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

        return redirect()->route('supply.student.index')->with($alert, $message);
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

            $importer = new StudentImport;
            $importer->setOrg(currentUser()->getOrg());

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

        return redirect()->route('supply.student.index')->with($alert, $message);
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
