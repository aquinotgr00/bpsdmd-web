<?php

namespace App\Http\Controllers\Demand;

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
    public function index(EmployeeService $employeeService)
    {
        $page = request()->get('page');
        $data = $employeeService->paginateEmployee(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate = url(route('demand.employee.create'));
        $urlUpdate = function($id) {
            return url(route('demand.employee.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('demand.employee.delete', [$id]));
        };
        $urlDetail = '/employee';
        $urlCertificate = url(route('demand.employeeCertificate.index'));

        return view('employee.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlCertificate'));
    }

    public function create(Request $request, EmployeeService $employeeService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'code' => 'required',
                'name' => 'required',
                'email' => 'nullable|email',
                'identity_number' => 'required',
                'location' => 'required',
                'duration' => 'required',
                'gender' => 'in:' . Employee::GENDER_MALE . ',' . Employee::GENDER_FEMALE,
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
                'email' => ucfirst(trans('common.email')),
                'identity_number' => ucfirst(trans('common.identity_number')),
                'location' => ucfirst(trans('common.location')),
                'duration' => ucfirst(trans('common.duration')),
                'gender' => ucfirst(trans('common.gender')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $org = currentUser()->getOrg();
            $messageBag = new MessageBag;

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

                $employeeService->create(collect($requestData), $org);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.employee'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.employee'))]);
            }

            return redirect()->route('demand.employee.index')->with($alert, $message);
        }

        $dataOrg        = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('employee.create', ['dataOrg' => $dataOrg]);
    }

    public function update(Request $request, EmployeeService $employeeService, Employee $data, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'code' => 'required',
                'name' => 'required',
                'email' => 'nullable|email',
                'identity_number' => 'required',
                'location' => 'required',
                'duration' => 'required',
                'gender' => 'in:' . Employee::GENDER_MALE . ',' . Employee::GENDER_FEMALE,
                'dateOfBirth' => 'required|date_format:"d-m-Y',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
                'email' => ucfirst(trans('common.email')),
                'identity_number' => ucfirst(trans('common.identity_number')),
                'location' => ucfirst(trans('common.location')),
                'duration' => ucfirst(trans('common.duration')),
                'gender' => ucfirst(trans('common.gender')),
                'dateOfBirth' => ucfirst(trans('common.date_of_birth')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            $org = currentUser()->getOrg();
            $messageBag = new MessageBag;

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

                $employeeService->update($data, collect($requestData), $org, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.employee'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.employee'))]);
            }

            return redirect()->route('demand.employee.index')->with($alert, $message);
        }

        $dataOrg        = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('employee.update', compact('data', 'dataOrg'));
    }

    public function delete(EmployeeService $employeeService, Employee $data)
    {
        try {
            $employeeService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.employee'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.employee'))]);
        }

        return redirect()->route('demand.employee.index')->with($alert, $message);
    }

    public function ajaxDetailEmployee(Request $request, Employee $data)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'email' => $data->getEmail() ? $data->getEmail() : '-',
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'gender' => $data->getGender() ? ucfirst($data->getGender()) : '-',
                'place_of_birth' => $data->getPlaceOfBirth() ? $data->getPlaceOfBirth() : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'language' => $data->getLanguage() ? $data->getLanguage() : '-',
                'nationality' => $data->getNationality() ? $data->getNationality() : '-',
                'degree' => $data->getDegree() ? $data->getDegree() : '-',
                'education_level' => $data->getEducationLevel() ? $data->getEducationLevel() : '-',
                'location' => $data->getLocation() ? $data->getLocation() : '-',
                'duration' => $data->getDuration() ? $data->getDuration() : '-',
                'major' => $data->getMajor() ? $data->getMajor() : '-',
                'phone_number' => $data->getPhoneNumber() ? $data->getPhoneNumber() : '-',
                'photo' => $data->getPhoto() ? url(url(Employee::UPLOAD_PATH.'/'.$data->getPhoto())) : url('img/avatar.png'),
            ];

            return response()->json($data);
        }

        return abort(404);
    }

    public function getByName(Request $request, EmployeeService $employeeService)
    {
        $employee = $employeeService->findByName($request->get('q'));
        return $employee;
    }
}
