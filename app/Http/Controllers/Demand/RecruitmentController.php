<?php

namespace App\Http\Controllers\Demand;

use App\Entities\Recruitment;
use App\Http\Controllers\Controller;
use App\Services\Domain\RecruitmentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class RecruitmentController extends Controller
{
    public function index(RecruitmentService $recruitmentService)
    {
        $page = request()->get('page');
        $data = $recruitmentService->paginateRecruitment(request()->get('page'));

        return view('recruitment.index', compact('data', 'page'));
    }
}
