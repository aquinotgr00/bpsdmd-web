<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\SupplyFiles;
use EntityManager;
use App\Services\Application\AuthService;

class FeederController extends Controller
{
    public function upload(Request $request, AuthService $authService)
    {
        if ($request->has('file')) {
            $uploadPath = 'test';
            $request->validate([
                'file' => 'required|mimes:xls,xlsx|max:1240',
            ]);

            $user = $authService->user();

            $file = $request->file('file');
            $uploadedFileName = str_replace(' ', '_', $file->getClientOriginalName());
            $fileName = explode("_",$uploadedFileName);

            $day = !empty($fileName[0]) ? (Int) substr($fileName[0],0,2) :99;
            $month = !empty($fileName[0]) ? (Int) substr($fileName[0],2,2) :99;
            $year = !empty($fileName[0]) ? (Int) substr($fileName[0],4,4) : 9999;

            if (!checkdate($month,$day,$year) || empty($fileName[0])) {
                $uploadedFileName= date('dmY').'_test.'.$file->getClientOriginalExtension();
            }

            if ($file->move($uploadPath, $uploadedFileName)) {
                $supply_files = new SupplyFiles();
                $supply_files->setId(rand(1, 1000000));
                $supply_files->setFileName($uploadedFileName);
                $supply_files->setUploadedBy($authService->check()['id']);
                $supply_files->setCreatedAt($request->post('created_at').'-01');
                $supply_files->setPath( $uploadPath);
                $supply_files->setOrgId($user->getOrg());

                EntityManager::persist($supply_files);
                EntityManager::flush();

                $request->session()->flash('success', 'File Berhasil Disimpan');
            } else {
                $request->session()->flash('error', 'File gagal Disimpan');
            }
        }

        return view('upload');
    }
}
