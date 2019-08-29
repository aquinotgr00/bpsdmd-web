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

        if ($request->post()) {
            $request->validate([
                'months' => 'required',
                'files' => 'required',
                'files.*' => 'mimes:xls,xlsx|max:1048'
            ]);
            $user = $authService->user();

            $uploadPath = $user->getOrg()->getName();
            $uploadPath = SupplyFiles::UPLOAD_PATH . $uploadPath;
            $files = $request->file('files');
            
            try {
                foreach ($request->get('months') as $key => $month) {
                    if (!empty($files[$key])) {
                        $file = $files[$key];
                        $uploadedFileName = str_replace(' ', '_', $file->getClientOriginalName());
                        $fileName = explode("_", $uploadedFileName);

                        $check_day = !empty($fileName[0]) ? (Int)substr($fileName[0], 0, 2) : 99;
                        $check_month = !empty($fileName[0]) ? (Int)substr($fileName[0], 2, 2) : 99;
                        $check_year = !empty($fileName[0]) ? (Int)substr($fileName[0], 4, 4) : 9999;

                        if (!checkdate($check_month, $check_day, $check_year) || empty($fileName[0])) {
                            $uploadedFileName = date('d').$month.$year. '_' . $user->getOrg()->getName() . '.' . $file->getClientOriginalExtension();
                        }

                        if ($file->move($uploadPath, $uploadedFileName)) {
                            $requestData = array();
                            $requestData['file_name'] = $uploadedFileName;
                            $requestData['upload_by'] = $user;
                            $requestData['created_at'] =  $year.'-'.$month.'-01';
                            $requestData['org'] = $user->getOrg();
                            $requestData['path'] = $uploadPath;
                            
                            if (empty($request->get('file_id')[$key])) {
                                $feederService->create(collect($requestData));
                            }
                            else{
                                $supplyFiles = $feederService->getRepository()->find($request->get('file_id')[$key]);
                                $feederService->update($supplyFiles, collect($requestData));
                            }
                        }

                    }
                }
                $request->session()->flash('success', 'File Berhasil Disimpan');
            } catch (\Exception $e) {
                report($e);
                $request->session()->flash('error', 'File Gagal Disimpan');

            }
        } 
        $files = [];

        for ($i = 1; $i <= 12; $i++) {
            $files[] = DB::table('supply_files AS sf')
            ->select('*')
            ->having(new Expression("to_char( sf.created_at, 'MM')"), sprintf('%02s', $i))
            ->groupBy('sf.id')->first();
        }

        return view('upload', ['files' => $files]);
    }

}
