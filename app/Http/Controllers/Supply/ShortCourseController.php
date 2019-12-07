<?php

namespace App\Http\Controllers\Supply;

use App\Http\Controllers\Controller;
use App\Services\Domain\OrgService;
use Illuminate\Http\Request;
use App\Services\Domain\ShortCourseService;

class ShortCourseController extends Controller
{
    public function index(ShortCourseService $shortCourseService, OrgService $orgService)
    {
        $page = request()->get('page');
        // $data = $shortCourseService->paginateShortCourse(request()->get('page'));
        $data = $shortCourseService->paginateShortCourseByOrg(request()->get('page'), currentUser()->getOrg());

        $orgs = $orgService->getRepository()->findAll();

        //build urls
        $urlCreate = url(route('administrator.shortCourse.create'));
        $urlUpdate = function($id) {
            return url(route('administrator.shortCourse.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('administrator.shortCourse.delete', [$id]));
        };
        $urlDetail = '/supply/short-course';

        return view('shortCourse.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'orgs'));
    }
}
