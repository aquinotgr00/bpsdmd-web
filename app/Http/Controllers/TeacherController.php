<?php

namespace App\Http\Controllers;

use App\Entities\Teacher;
use App\Entities\Organization;
use App\Services\Domain\TeacherService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Exceptions\TeacherDeleteException;
use Image;

class TeacherController extends Controller
{
    public function index(TeacherService $teacherService)
    {
        $page = request()->get('page');
        $data = $teacherService->paginateTeacher(request()->get('page'));

        return view('teacher.index', compact('data', 'page'));
    }

    public function create(Request $request, TeacherService $teacherService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('teacher.create')->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $teacherService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = 'Dosen berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah dosen. Silakan kontak web administrator!';
            }

            return redirect()->route('teacher.index')->with($alert, $message);
        }

        $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('teacher.create', ['dataOrg' => $dataOrg]);
    }

    public function update(Request $request, TeacherService $teacherService, Teacher $data, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('teacher.update', ['id' => $data->getId()])->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $teacherService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = 'Dosen berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah dosen. Silakan kontak web administrator!';
            }

            return redirect()->route('teacher.index')->with($alert, $message);
        }

        $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('teacher.update', compact('data', 'dataOrg'));
    }

    public function delete(TeacherService $teacherService, Teacher $data)
    {
        try {
            $teacherService->delete($data);
            $alert = 'alert_success';
            $message = 'Dosen berhasil dihapus.';
        } catch (TeacherDeleteException $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus dosen karena masih terdapat user dosen!';
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus dosen. Silakan kontak web administrator!';
        }

        return redirect()->route('teacher.index')->with($alert, $message);
    }

    public function ajaxDetailTeacher(Request $request, Teacher $data)
    {
        if ($request->ajax()) {
            $data = [
                'nip' => $data->getNip(),
                'name' => $data->getName(),
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'date_of_birth' => ($data->getDateOfBirth() instanceof DateTime) ? $data->getDateOfBirth() : false,
                'front_degree' => $data->getFrontDegree(),
                'back_degree' => $data->getBackDegree(),
                'identity_number' => $data->getIdentityNumber(),
                'nidn' => $data->getNidn()
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
