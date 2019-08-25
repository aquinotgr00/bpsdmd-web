<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\SupplyFiles;
use EntityManager;
use App\Services\Application\AuthService;

class FeederController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function upload(Request $request,AuthService $authwervice)
    {
        if ($request->has('file')) {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx|max:1240',
            ]);

            // $user = EntityManager::getRepository(User::class)->findOneBy(['id' => $request->session()->get('logged')['id']]);
            $user = $authwervice->user();

            $file = $request->file('file');
            $uploadedFileName = str_replace(' ', '_', $file->getClientOriginalName());
            $fileName = explode("_",$uploadedFileName);

            $day = !empty($fileName[0]) ? (Int) substr($fileName[0],0,2) :99;
            $month = !empty($fileName[0]) ? (Int) substr($fileName[0],2,2) :99;
            $year = !empty($fileName[0]) ? (Int) substr($fileName[0],4,4) : 9999;

            if (!checkdate($month,$day,$year) || empty($fileName[0])) {
                $uploadedFileName= date('dmY').'_test.'.$file->getClientOriginalExtension();
            }

            $uploadpath = 'test';
            if ($file->move($uploadpath,$uploadedFileName)) {

                $supply_files = new SupplyFiles();
                $supply_files->setId(rand(1, 1000000));
                $supply_files->setFileName($uploadedFileName);
                $supply_files->setUploadedBy($request->session()->get('logged')['id']);
                $supply_files->setCreatedAt($request->post('created_at').'-01');
                $supply_files->setPath( $uploadpath);
                $supply_files->setOrgId($user->getOrg());

                EntityManager::persist($supply_files);
                EntityManager::flush();

                $request->session()->flash('success', 'File Berhasil Disimpan');
            }
            else{
                $request->session()->flash('error', 'File gagal Disimpan');
            }
        }


        return view('upload');
    }
}
