<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\ShortCourseData;
use App\Entities\ShortCourse;
use App\Http\Controllers\Controller;
use App\Services\Domain\ShortCourseDataService;
use App\Services\Domain\ShortCourseService;
use App\Services\Domain\ShortCourseParticipantService;
use Exception;
use Illuminate\Http\Request;

class ShortCourseDataController extends Controller
{
    public function index(ShortCourseDataService $shortCourseDataService, ShortCourse $shortCourse, ShortCourseParticipantService $shortCourseParticipantService)
    {
        $page = request()->get('page');
        $data = $shortCourseDataService->getRepository()->findOneBy(['shortCourse' => $shortCourse->getId()]);
        $shortCourseParticipants = $shortCourseParticipantService->getRepository()->findBy(['shortCourse' => $shortCourse->getId()]);

        //build urls
        $urlCreate = url(route('administrator.shortCourseData.create', [$shortCourse->getId()]));
        $urlUpdate = function($id) use ($shortCourse) {
            return url(route('administrator.shortCourseData.update', [$shortCourse->getId(), $id]));
        };
        $urlDelete = function($id) use ($shortCourse) {
            return url(route('administrator.shortCourseData.delete', [$shortCourse->getId(), $id]));
        };
        $urlDetail = '/short-course/'.$shortCourse->getId().'/short-course-data';

        return view('shortCourseData.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'shortCourseParticipants'));
    }

    public function create(Request $request, ShortCourseDataService $shortCourseDataService, ShortCourse $shortCourse)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'startDate' => 'required|date_format:"d-m-Y"',
                'endDate' => 'required|date_format:"d-m-Y"',
            ];

            $request->validate($validation, [], [
                'startDate' => ucfirst(trans('common.start_date')),
                'endDate' => ucfirst(trans('common.end_date')),
            ]);

            try {
                $requestData = $request->all();

                $shortCourseDataService->create(collect($requestData), $shortCourse);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.short_course_data'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.short_course_data'))]);
            }

            return redirect()->route('administrator.shortCourseData.index', ['shortCourse' => $shortCourse->getId()])->with($alert, $message);
        }

        return view('shortCourseData.create');
    }

    public function update(Request $request, ShortCourseDataService $shortCourseDataService, ShortCourse $shortCourse, ShortCourseData $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'startDate' => 'required|date_format:"d-m-Y"',
                'endDate' => 'required|date_format:"d-m-Y"',
            ];

            $request->validate($validation, [], [
                'startDate' => ucfirst(trans('common.start_date')),
                'endDate' => ucfirst(trans('common.end_date')),
            ]);

            try {
                $requestData = $request->all();

                $shortCourseDataService->update($data, collect($requestData), $shortCourse, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.short_course_data'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.short_course_data'))]);
            }

            return redirect()->route('administrator.shortCourseData.index', ['shortCourse' => $shortCourse->getId()])->with($alert, $message);
        }

        return view('shortCourseData.update', compact('data'));
    }

    public function delete(ShortCourseDataService $shortCourseDataService, ShortCourse $shortCourse, ShortCourseData $data)
    {
        try {
            $shortCourseDataService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.short_course_data'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.short_course_data'))]);
        }

        return redirect()->route('administrator.shortCourseData.index', ['shortCourse' => $shortCourse->getId()])->with($alert, $message);
    }
}
