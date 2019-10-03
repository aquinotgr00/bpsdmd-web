<?php

namespace App\Http\Controllers;

use App\Entities\Student;
use App\Entities\Organization;
use App\Services\Domain\StudentService;
use App\Services\Domain\OrgService;
use App\Services\Domain\ProgramService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Exceptions\StudentDeleteException;
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
                'org' => 'required'
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
                $message = 'Siswa berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah siswa. Silakan kontak web administrator!';
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
                'org' => 'required'
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
                $message = 'Siswa berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah siswa. Silakan kontak web administrator!';
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
            $message = 'Siswa berhasil dihapus.';
        } catch (StudentDeleteException $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus siswa karena masih terdapat user siswa!';
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus siswa. Silakan kontak web administrator!';
        }

        return redirect()->route('student.index')->with($alert, $message);
    }

    public function ajaxDetailStudent(Request $request, Student $data)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode(),
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'study_program' => ($data->getStudyProgram() instanceof StudyProgram) ? $data->getStudyProgram()->getName() : false,
                'period' => $data->getPeriod(),
                'curriculum' => ($data->getCurriculum() instanceof DateTime) ? $data->getCurriculum() : null,
                'date_of_birth' => ($data->getDateOfBirth() instanceof DateTime) ? $data->getDateOfBirth() : false,
                'class' => $data->getClass(),
                'ipk' => $data->getIpk()
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}