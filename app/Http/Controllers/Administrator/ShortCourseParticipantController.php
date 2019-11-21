<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Domain\ShortCourseService;
use App\Services\Domain\ShortCourseDataService;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\ShortCourseParticipantService;
use Exception;

class ShortCourseParticipantController extends Controller
{
    public function create(
      Request $request,
      ShortCourseService $shortCourseService,
      ShortCourseDataService $shortCourseDataService,
      ShortCourseParticipantService $shortCourseParticipantService,
      EmployeeService $employeeService
    )
    {
        if ($request->method() === 'POST') {
            $validation = [];
            $request->validate($validation, [], []);

            $shortCourse = $shortCourseService->findById($request->get('short_course_id'));
            $shortCourseData = $shortCourseDataService->getRepository()->findOneBy(['shortCourse' => $shortCourse->getId()]);
            $shortCourseData->setTotalRealization($shortCourseData->getTotalRealization() + 1);
            $employee = $employeeService->findById($request->get('employee_id'));

            try {
                $shortCourseParticipantService->create(
                    collect($request->only(['background', 'graduate', 'competence_certificat', 'training_certificat'])),
                    $shortCourse,
                    $employee
                );

                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.short_course_participant'))]);
            } catch (Exception $e) {
                response($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.short_course_participant'))]);
            }

            return redirect()->route('administrator.shortCourseData.index', $request->get('short_course_id'))->with($alert, $message);
        }

        return view('shortCourseParticipant.create');
    }
}
