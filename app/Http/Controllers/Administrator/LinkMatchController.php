<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;

class LinkMatchController extends Controller
{
    public function index()
    {
        return view('linkmatch.index');
    }
}
