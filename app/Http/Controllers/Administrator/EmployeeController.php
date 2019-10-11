<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Employee;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class EmployeeController extends Controller
{
    public function index(EmployeeService $employeeService, Organization $org)
    {
        $page = request()->get('page');
        $data = $employeeService->paginateEmployee(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.employee.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            return url(route('administrator.employee.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            return url(route('administrator.employee.delete', [$org->getId(), $id]));
        };
        $urlDetail = '/org/'.$org->getId().'/employee';

        return view('employee.index', compact('data', 'page', 'org', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail'));
    }

    public function create(Request $request, EmployeeService $employeeService, OrgService $orgService, Organization $org)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'code' => 'required',
                'name' => 'required',
                'identity_number' => 'required',
                'school' => 'required',
                'gender' => 'in:' . Employee::GENDER_MALE . ',' . Employee::GENDER_FEMALE,
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
                'identity_number' => ucfirst(trans('common.identity_number')),
                'school' => ucfirst(trans('common.school')),
                'gender' => ucfirst(trans('common.gender')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $messageBag = new MessageBag;

            $school = false;
            if ($request->get('school')) {
                $school = $orgService->findById($request->get('school'));
            }
            if (!$school) {
                $messageBag->add('school', trans('common.invalid_school'));
                return redirect()->route('administrator.employee.create', ['org' => $org->getId()])->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Employee::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $employeeService->create(collect($requestData), $org, $school);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.employee'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.employee'))]);
            }

            return redirect()->route('administrator.employee.index', ['org' => $org->getId()])->with($alert, $message);
        }

        $dataSchool     = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataOrg        = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('employee.create', ['dataSchool' => $dataSchool, 'dataOrg' => $dataOrg]);
    }

    public function update(Request $request, EmployeeService $employeeService, OrgService $orgService, Organization $org, Employee $data)
    {
        if($org->getId() != $data->getOrg()->getId()){
            return abort(404);
        }
        if ($request->method() == 'POST') {
            $validation = [
                'code' => 'required',
                'name' => 'required',
                'identity_number' => 'required',
                'school' => 'required',
                'gender' => 'in:' . Employee::GENDER_MALE . ',' . Employee::GENDER_FEMALE,
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
                'identity_number' => ucfirst(trans('common.identity_number')),
                'school' => ucfirst(trans('common.school')),
                'gender' => ucfirst(trans('common.gender')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $messageBag = new MessageBag;

            $school = false;
            if ($request->get('school')) {
                $school = $orgService->findById($request->get('school'));
            }
            if (!$school) {
                $messageBag->add('school', trans('common.invalid_school'));
                return redirect()->route('administrator.employee.update', ['org' => $org->getId(), 'employee' => $data->getId()])->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Employee::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $employeeService->update($data, collect($requestData), false, $school, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.employee'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.employee'))]);
            }

            return redirect()->route('administrator.employee.index', ['org' => $org->getId()])->with($alert, $message);
        }

        $dataSchool     = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataOrg        = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('employee.update', compact('data', 'dataSchool', 'dataOrg'));
    }

    public function delete(EmployeeService $employeeService, Organization $org, Employee $data)
    {
        if($org->getId() != $data->getOrg()->getId()){
            return abort(404);
        }
        try {
            $employeeService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.employee'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.employee'))]);
        }

        return redirect()->route('administrator.employee.index', ['org' => $org->getId()])->with($alert, $message);
    }

    public function ajaxDetailEmployee(Request $request, Organization $org, Employee $data)
    {
        if($org->getId() != $data->getOrg()->getId()){
            return abort(404);
        }
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'school' => ($data->getSchool() instanceof Organization) ? $data->getSchool()->getName() : false,
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'gender' => $data->getGender() ? ucfirst($data->getGender()) : '-',
                'place_of_birth' => $data->getPlaceOfBirth() ? $data->getPlaceOfBirth() : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'language' => $data->getLanguage() ? $data->getLanguage() : '-',
                'nationality' => $data->getNationality() ? $data->getNationality() : '-',
                'photo' => $data->getPhoto() ? url(url(Employee::UPLOAD_PATH.'/'.$data->getPhoto())) : url('img/avatar.png'),
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
