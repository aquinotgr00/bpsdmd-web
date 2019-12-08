<?php

namespace App\Http\Controllers\Supply;

use App\Entities\Organization;
use App\Entities\Student;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Services\Application\AuthService;
use App\Services\Domain\FeederService;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use App\Services\Domain\StudentService;
use DateTime;
use DB;
use Exception;
use Illuminate\Http\Request;
use Image;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(StudentService $studentService)
    {
        $page = request()->get('page');
        $data = $studentService->paginateStudent(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate   = url(route('supply.student.create'));
        $urlUpdate = function ($id) {
            return url(route('supply.student.update', [$id]));
        };
        $urlDelete = function ($id) {
            return url(route('supply.student.delete', [$id]));
        };
        $urlDetail = '/student';
        $urlTemplate = url(route('supply.student.template.download'));
        $urlUpload = url(route('supply.student.upload'));

        $studyPrograms = DB::table("program_studi")->where("instansi_id", currentUser()->getOrg()->getId())->select("id", "nama")->get()->toArray();

        return view('student.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlTemplate', 'urlUpload', 'studyPrograms'));
    }

    public function create(Request $request, StudentService $studentService, OrgService $orgService, ProgramService $programService)
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
        $file->move(storage_path('excel'), $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $feeder = $feederService->create(collect($dataFeeder));

            $importer = new StudentImport;
            $importer->setOrg(currentUser()->getOrg());

            Excel::import($importer, storage_path('/excel/'.$nama_file));

            //update status feeder
            $errors = $importer->getErrors();
            $feederService->activeFeeder($feeder, $errors);

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
                'id_dikti' => $data->getIdDikti() ? $data->getIdDikti() : '-',
                'nim' => $data->getNim() ? $data->getNim() : '-',
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'study_program' => ($data->getStudyProgram() instanceof StudyProgram) ? $data->getStudyProgram()->getName() : '-',
                'period' => $data->getPeriod() ? $data->getPeriod() : '-',
                'curriculum' => $data->getCurriculum() ? $data->getCurriculum() : '-',
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'gender' => $data->getGender() ? ucfirst($data->getGender()) : '-',
                'place_of_birth' => $data->getPlaceOfBirth() ? $data->getPlaceOfBirth() : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'address' => $data->getAddress() ? $data->getAddress() : '-',
                'phone_number' => $data->getPhoneNumber() ? $data->getPhoneNumber() : '-',
                'mobile_phone_number' => $data->getMobilePhoneNumber() ? $data->getMobilePhoneNumber() : '-',
                'email' => $data->getEmail() ? $data->getEmail() : '-',
                'religion' => $data->getReligion() ? $data->getReligion() : '-',
                'mother_name' => $data->getMotherName() ? $data->getMotherName() : '-',
                'nationality' => $data->getNationality() ? $data->getNationality() : '-',
                'foreign_citizen' => $data->getForeignCitizen() == 't' ? trans('common.yes') : trans('common.no'),
                'social_protection_card' => $data->getSocialProtectionCard() == 't' ? trans('common.yes') : trans('common.no'),
                'occupation_type' => $data->getOccupationType() ? $data->getOccupationType() : '-',
                'enrollment_date_start' => $data->getEnrollmentDateStart() instanceof DateTime ? $data->getEnrollmentDateStart()->format('d F Y') : '-',
                'enrollment_date_end' => $data->getEnrollmentDateEnd() instanceof DateTime ? $data->getEnrollmentDateEnd()->format('d F Y') : '-',
                'start_semester' => $data->getStartSemester() ? $data->getStartSemester() : '-',
                'current_semester' => $data->getCurrentSemester() ? $data->getCurrentSemester() : '-',
                'student_credits' => $data->getStudentCredits() ? $data->getStudentCredits() : '-',
                'certificate_number' => $data->getCertificateNumber() ? $data->getCertificateNumber() : '-',
                'graduation_judgement_date' => $data->getGraduationJudgementDate() instanceof DateTime ? $data->getGraduationJudgementDate()->format('d F Y') : '-',
                'enrollment_type' => $data->getEnrollmentType() ? $data->getEnrollmentType() : '-',
                'graduation_type' => $data->getGraduationType() ? $data->getGraduationType() : '-',
                'status' => $data->getStatus() ? $data->getStatus() : '-',
                'class' => $data->getClass() ? $data->getClass() : '-',
                'ipk' => $data->getIpk() ? $data->getIpk() : '-',
                'graduation_year' => $data->getGraduationYear() ? $data->getGraduationYear() : '-',
                'photo' => $data->getPhoto() ? url(url(Student::UPLOAD_PATH . '/' . $data->getPhoto())) : url('img/avatar.png'),
            ];

            return response()->json($data);
        }

        return abort(404);
    }

    public function templateDownload()
    {
        $file = public_path(). "/download/template-siswa.xlsx";
        return response()->download($file, 'template.xlsx');
    }
}
