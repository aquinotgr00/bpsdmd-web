<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\TeacherImport;
use App\Services\Application\AuthService;
use App\Services\Domain\FeederService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;
use Maatwebsite\Excel\Facades\Excel;

class FeederController extends Controller
{
    public function index(FeederService $feederService)
    {
        return view('feeder.index');
    }

    public function upload(Request $request, FeederService $feederService)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move(storage_patch('excel'), $nama_file);

        //insert feeder
        Excel::import(new TeacherImport, storage_patch('/excel/'.$nama_file));

        //update status feeder to 1 
        $alert = 'alert_success';
        $message = 'Import Success';

        return view('feeder.index');
    }
}
