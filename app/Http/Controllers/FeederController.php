<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\SupplyFiles;
use EntityManager;
use App\Services\Application\AuthService;
use App\Services\Domain\OrgService;

class FeederController extends Controller
{
    public function upload(Request $request, AuthService $authService, OrgService $orgService)
    {
        if ($request->has('file')) {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx|max:1240',
            ]);

            $user   = $authService->user();
            $org    = $orgService->getRepository()->findOneBy(['id' => $user->getOrg()->getId()]);

            $uploadPath = $org->getName();
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
                $supplyFiles = new SupplyFiles();
                $supplyFiles->setFileName($uploadedFileName);
                $supplyFiles->setUploadedBy($user);
                $supplyFiles->setCreatedAt($request->post('created_at').date('d'));
                $supplyFiles->setPath( $uploadPath);
                $supplyFiles->setOrg($user->getOrg());

                EntityManager::persist($supplyFiles);
                EntityManager::flush();

                $request->session()->flash('success', 'File Berhasil Disimpan');
            } else {
                $request->session()->flash('error', 'File gagal Disimpan');
            }
        }

        return view('upload');
    }
}
