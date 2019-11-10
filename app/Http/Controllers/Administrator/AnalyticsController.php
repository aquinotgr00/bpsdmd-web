<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view('analytics.index');
    }

    public function students()
    {
        return view('analytics.students');
    }

    public function shortcourse()
    {
        return view('analytics.shortcourse');
    }

    public function studyprogram()
    {
        return view('analytics.studyprogram');
    }

    public function employee()
    {
        return view('analytics.employee');
    }
}
