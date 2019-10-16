<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\LinkMatch;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class LinkMatchController extends Controller
{
    public function index()
    {
        return view('linkmatch.index');
    }
}
