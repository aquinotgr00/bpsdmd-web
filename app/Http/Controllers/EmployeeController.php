<?php

namespace App\Http\Controllers;

use App\Entities\Employee;
use App\Entities\Organization;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Exceptions\EmployeeDeleteException;
use Image;

class EmployeeController extends Controller
{
    public function index(EmployeeService $employeeService)
    {
        $page = request()->get('page');
        $data = $employeeService->paginateEmployee(request()->get('page'));

        return view('employee.index', compact('data', 'page'));
    }

    public function create(Request $request, EmployeeService $employeeService, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'school' => 'required',
                'org' => 'required',
                'gender' => 'in:' . Employee::GENDER_MALE . ',' . Employee::GENDER_FEMALE,
                'dateOfBirth' => 'required|date_format:"d-m-Y',
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('employee.create')->withErrors($messageBag);
            }

            $school = false;
            if ($request->get('school')) {
                $school = $orgService->findById($request->get('school'));
            }
            if (!$school) {
                $messageBag->add('school', trans('common.invalid_institute'));
                return redirect()->route('employee.create')->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $employeeService->create(collect($requestData), $org, $school);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.employee'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.employee'))]);
            }

            return redirect()->route('employee.index')->with($alert, $message);
        }

        $dataSchool     = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataOrg        = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('employee.create', ['dataSchool' => $dataSchool, 'dataOrg' => $dataOrg]);
    }

    public function update(Request $request, EmployeeService $employeeService, Employee $data, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'school' => 'required',
                'org' => 'required',
                'gender' => 'in:' . Employee::GENDER_MALE . ',' . Employee::GENDER_FEMALE,
                'dateOfBirth' => 'required|date_format:"d-m-Y'
            ]);

            $messageBag = new MessageBag;
            $org = false;
            if ($request->get('org')) {
                $org = $orgService->findById($request->get('org'));
            }
            if (!$org) {
                $messageBag->add('org', trans('common.invalid_institute'));
                return redirect()->route('employee.update', ['id' => $data->getId()])->withErrors($messageBag);
            }

            $school = false;
            if ($request->get('school')) {
                $school = $orgService->findById($request->get('school'));
            }
            if (!$school) {
                $messageBag->add('school', trans('common.invalid_institute'));
                return redirect()->route('employee.update', ['id' => $data->getId()])->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $employeeService->update($data, collect($requestData), $org, $school, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.employee'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.employee'))]);
            }

            return redirect()->route('employee.index')->with($alert, $message);
        }

        $dataSchool     = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        $dataOrg        = $orgService->getOrgByType(Organization::TYPE_DEMAND);

        return view('employee.update', compact('data', 'dataSchool', 'dataOrg'));
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

        return redirect()->route('employee.index')->with($alert, $message);
    }

    public function ajaxDetailEmployee(Request $request, Employee $data)
    {
        if ($request->ajax()) {
            $data = [
                'code' => $data->getCode() ? $data->getCode() : '-',
                'name' => $data->getName(),
                'school' => ($data->getSchool() instanceof Organization) ? $data->getSchool()->getName() : false,
                'org' => ($data->getOrg() instanceof Organization) ? $data->getOrg()->getName() : false,
                'identity_number' => $data->getIdentityNumber() ? $data->getIdentityNumber() : '-',
                'gender' => $data->getGender() ? $data->getGender() : '-',
                'place_of_birth' => $data->getPlaceOfBirth() ? $data->getPlaceOfBirth() : '-',
                'date_of_birth' => $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d F Y') : '-',
                'language' => $data->getLanguage() ? $data->getLanguage() : '-',
                'nationality' => $data->getNationality() ? $data->getNationality() : '-'
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
