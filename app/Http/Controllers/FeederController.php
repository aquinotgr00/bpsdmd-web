<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\SupplyFiles;
use App\Services\Application\AuthService;
use App\Services\Domain\FeederService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;
class FeederController extends Controller
{
    public function upload(Request $request, AuthService $authService, FeederService $feederService, $year = null)
    {
        $files = [];

        for ($i=1; $i <= 12; $i++) { 
        $files[] = DB::table('supply_files AS sf')
        ->select('*')
        ->having(new Expression("to_char( sf.created_at, 'MM')"), sprintf('%02s', $i))
        ->groupBy('sf.id')->first();
        }
        
        if ($request->has('file')) {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx|max:1240',
            ]);

            $user = $authService->user();

            $uploadPath = $user->getOrg()->getName();
            $uploadPath = SupplyFiles::UPLOAD_PATH.$uploadPath;

            $file = $request->file('file');
            $uploadedFileName = str_replace(' ', '_', $file->getClientOriginalName());
            $fileName = explode("_",$uploadedFileName);

            $day = !empty($fileName[0]) ? (Int) substr($fileName[0],0,2) :99;
            $month = !empty($fileName[0]) ? (Int) substr($fileName[0],2,2) :99;
            $year = !empty($fileName[0]) ? (Int) substr($fileName[0],4,4) : 9999;

            if (!checkdate($month,$day,$year) || empty($fileName[0])) {
                $uploadedFileName= date('dmY').'_'.$org->getName().'.'.$file->getClientOriginalExtension();
            }

            if ($file->move($uploadPath, $uploadedFileName)) {
                $requestData = $request->all();
                $requestData['fileName']    = $uploadedFileName;
                $requestData['user']        = $user;
                $requestData['created_at']  = $user;
                $requestData['org']         = $user->getOrg();

                // $supplyFiles = new SupplyFiles();
                // $supplyFiles->setFileName($uploadedFileName);
                // $supplyFiles->setUploadedBy($user);
                // $supplyFiles->setCreatedAt($request->post('created_at').date('d'));
                // $supplyFiles->setPath( $uploadPath);
                // $supplyFiles->setOrg($user->getOrg());


                $request->session()->flash('success', 'File Berhasil Disimpan');
            } else {
                $request->session()->flash('error', 'File gagal Disimpan');
            }
        }

        return view('upload',['files'=>$files]);
    }
}
