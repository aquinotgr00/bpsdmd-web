<?php

namespace App\Http\Controllers\Demand;

use App\Entities\Student;
use App\Entities\Recruitment;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Http\Controllers\Controller;
use App\Mail\RecruitmentMail;
use App\Services\Domain\StudentService;
use App\Services\Domain\RecruitmentService;
use App\Services\Domain\JobTitleService;
use App\Services\Domain\ProgramService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;
use Mail;

class OfferingController extends Controller
{
    public function index(RecruitmentService $recruitmentService)
    {
        $org  = currentUser()->getOrg();
        $page = request()->get('page');
        $data = $recruitmentService->paginateRecruitment(request()->get('page'), $org);

        //build urls
        $urlUpdate = function($id) {
            return url(route('demand.offering.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('demand.offering.delete', [$id]));
        };
        $urlEmail = function($id) {
            return url(route('demand.offering.email', [$id]));
        };

        return view('recruitment.offer', compact('data', 'page', 'urlUpdate', 'urlDelete', 'urlEmail'));
    }

    public function update(Request $request, RecruitmentService $recruitmentService, Recruitment $data, StudentService $studentService, JobTitleService $jobTitleService)
    {
        if ($request->method() == 'POST') {
            $org = currentUser()->getOrg();
            $messageBag = new MessageBag;

            $student = false;
            if ($request->get('student')) {
                $student = $studentService->findById($request->get('student'));
            }
            $jobTitle = false;
            if ($request->get('jobTitle')) {
                $jobTitle = $jobTitleService->findById($request->get('jobTitle'));
            }
            if (!$jobTitle) {
                $messageBag->add('jobTitle', trans('common.invalid_job_title'));
                return redirect()->route('demand.offering.update', ['id' => $data->getId()])->withErrors($messageBag);
            }
            try {
                $requestData = $request->all();
                $recruitmentService->update($data, collect($requestData), $org, $student, $jobTitle, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.recruitment'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.recruitment'))]);
            }

            return redirect()->route('demand.offering.index')->with($alert, $message);
        }
        $dataJobTitle = $jobTitleService->getRepository()->findAll();

        return view('recruitment.update', compact('data', 'dataJobTitle'));
    }

    public function delete(RecruitmentService $recruitmentService, Recruitment $data)
    {
        $org = currentUser()->getOrg();
        try {
            $recruitmentService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.recruitment'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.recruitment'))]);
        }

        return redirect()->route('demand.offering.index', ['org' => $org->getId()])->with($alert, $message);
    }

    public function email(RecruitmentService $recruitmentService, Recruitment $data)
    {
        $org = currentUser()->getOrg();
        try {
            $url = env('APP_URL') .'/offering';
            // Mail::to($data->getStudent()->getEmail())->send(new RecruitmentMail($url));                // send recruitment email

            $alert = 'alert_success';
            $message = trans('common.email_success', ['object' => ucfirst(trans('common.recruitment'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.email_failed', ['object' => ucfirst(trans('common.recruitment'))]);
        }

        return redirect()->route('demand.offering.index', ['org' => $org->getId()])->with($alert, $message);
    }
}
