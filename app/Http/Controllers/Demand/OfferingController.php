<?php

namespace App\Http\Controllers\Demand;

use App\Http\Controllers\Controller;

class OfferingController extends Controller
{
    public function index()
    {
        return view('recruitment.offer');
    }
}
