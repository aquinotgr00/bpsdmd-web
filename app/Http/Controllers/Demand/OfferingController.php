<?php

namespace App\Http\Controllers\Demand;

use App\Entities\Offering;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class OfferingController extends Controller
{
    public function index()
    {
        return view('recruitment.offer');
    }
}
