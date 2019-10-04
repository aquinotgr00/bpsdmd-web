<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\TeacherImport;
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
        $file->move('feeder', $nama_file);

        Excel::import(new TeacherImport, public_path('/feeder/'.$nama_file));

        $alert = 'alert_success';
        $message = 'Import Success';

        return view('feeder.index');
    }
}
