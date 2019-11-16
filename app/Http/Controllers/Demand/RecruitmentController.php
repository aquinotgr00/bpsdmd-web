<?php

namespace App\Http\Controllers\Demand;

use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Services\Domain\StudentService;
use App\Services\Domain\RecruitmentService;
use App\Services\Domain\ProgramService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index(Request $request, RecruitmentService $recruitmentService, OrgService $orgService, StudentService $studentService, ProgramService $programService)
    {
        $requestData = null;
        $studyProgram = false;
        if ($request->get('studyProgram')) {
            $studyProgram = $programService->findById($request->get('studyProgram'));
        }
        if ($request->method() == 'POST') {
            $requestData = $request->all();
        }
        $org  = currentUser()->getOrg();
        $page = request()->get('page');
        $data = $recruitmentService->paginateRecruitment(request()->get('page'), $org);

        $allStudent     = $studentService->getRepository()->findAll();
        $student 		= $studentService->paginateRecruitment(request()->get('page'), collect($requestData), $studyProgram);
        $dataProgram 	= $programService->getRepository()->findAll();
        $urlDetail 		= '/recruitment';

        return view('recruitment.index', compact('data', 'allStudent', 'student', 'dataProgram', 'page', 'urlDetail'));
    }

    public function create(Request $request, RecruitmentService $recruitmentService, StudentService $studentService, Student $student)
    {
        $org = currentUser()->getOrg();
        try {
            $requestData = $request->all();
            $recruitmentService->create(collect($requestData), $org, $student);

            $alert = 'alert_success';
            $message = trans('common.create_success', ['object' => ucfirst(trans('common.recruitment'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.create_failed', ['object' => ucfirst(trans('common.recruitment'))]);
        }

        return redirect()->route('demand.recruitment.index')->with($alert, $message);
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
                'graduation_year' => $data->getGraduationYear() ? $data->getGraduationYear() : '-',
                'photo' => $data->getPhoto() ? url(url(Student::UPLOAD_PATH.'/'.$data->getPhoto())) : url('img/avatar.png'),
                'add_chart' => url(url(route('demand.recruitment.create', [$data->getId()]))),
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
