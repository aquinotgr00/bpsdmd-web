<?php

namespace App\Http\Controllers\Demand;

use App\Entities\EmployeeCertificate;
use App\Entities\Employee;
use App\Entities\Certificate;
use App\Http\Controllers\Controller;
use App\Services\Domain\EmployeeCertificateService;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\CertificateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class EmployeeCertificateController extends Controller
{
    public function index(EmployeeCertificateService $employeeCertificateService)
    {
        $page = request()->get('page');
        $data = $employeeCertificateService->paginateEmployeeCertificate(request()->get('page'), currentUser()->getOrg());

        //build urls
        $urlCreate = url(route('demand.employeeCertificate.create'));
        $urlUpdate = function($id){
            return url(route('demand.employeeCertificate.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('demand.employeeCertificate.delete', [$id]));
        };
        $urlDetail = '/employee-certificate';
        $urlUpload = url(route('demand.employeeCertificate.upload'));

        return view('employeeCertificate.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, EmployeeCertificateService $employeeCertificateService, EmployeeService $employeeService, CertificateService $certificateService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'validityPeriod' => 'required|numeric',
            ];

            $request->validate($validation, [], [
                'validityPeriod' => ucfirst(trans('common.validity_period')),
            ]);

            $messageBag = new MessageBag;

            $employee = false;
            if ($request->get('employee')) {
                $employee = $employeeService->findById($request->get('employee'));
            }
            if (!$employee) {
                $messageBag->add('employee', trans('common.invalid_employee'));
                return redirect()->route('demand.employeeCertificate.create')->withErrors($messageBag);
            }
            $certificate = false;
            if ($request->get('certificate')) {
                $certificate = $certificateService->findById($request->get('certificate'));
            }
            if (!$certificate) {
                $messageBag->add('certificate', trans('common.invalid_certificate'));
                return redirect()->route('demand.employeeCertificate.create')->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();

                $employeeCertificateService->create(collect($requestData), $employee, $certificate);
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.certificate'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.certificate'))]);
            }

            return redirect()->route('demand.employeeCertificate.index')->with($alert, $message);
        }

        $dataEmployee       = $employeeService->getRepository()->findBy(['org' => currentUser()->getOrg()]);
        $dataCertificate    = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.create', ['dataEmployee' => $dataEmployee,'dataCertificate' => $dataCertificate]);
    }

    public function update(Request $request, EmployeeCertificateService $employeeCertificateService, EmployeeService $employeeService, CertificateService $certificateService, EmployeeCertificate $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'validityPeriod' => 'required|numeric',
            ];

            $request->validate($validation, [], [
                'validityPeriod' => ucfirst(trans('common.validityPeriod')),
            ]);

            $messageBag = new MessageBag;

            $employee = false;
            if ($request->get('employee')) {
                $employee = $employeeService->findById($request->get('employee'));
            }
            if (!$employee) {
                $messageBag->add('employee', trans('common.invalid_employee'));
                return redirect()->route('demand.employeeCertificate.update')->withErrors($messageBag);
            }
            $certificate = false;
            if ($request->get('certificate')) {
                $certificate = $certificateService->findById($request->get('certificate'));
            }
            if (!$certificate) {
                $messageBag->add('certificate', trans('common.invalid_certificate'));
                return redirect()->route('demand.employeeCertificate.update')->withErrors($messageBag);
            }

            try {
                $requestData = $request->all();
                $employeeCertificateService->update($data, collect($requestData), $employee, $certificate, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.certificate'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.certificate'))]);
            }

            return redirect()->route('demand.employeeCertificate.index', ['employee' => $employee->getId()])->with($alert, $message);
        }

        $dataEmployee       = $employeeService->getRepository()->findBy(['org' => currentUser()->getOrg()]);
        $dataCertificate    = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.update', compact('data', 'dataEmployee', 'dataCertificate'));
    }

    public function delete(EmployeeCertificateService $employeeCertificateService, EmployeeCertificate $data)
    {
        try {
            $employeeCertificateService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.certificate'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.certificate'))]);
        }

        return redirect()->route('demand.employeeCertificate.index')->with($alert, $message);
    }

    public function ajaxDetailEmployeeCertificate(Request $request, Employee $employee, Certificate $certificate, EmployeeCertificate $data)
    {
        if ($request->ajax()) {
            $data = [
                'employee' => ($data->getEmployee() instanceof Employee) ? $data->getEmployee()->getName() : false,
                'certificate' => ($data->getCertificate() instanceof Certificate) ? $data->getCertificate()->getName() : false,
                'validity_period' => $data->getValidityPeriod() ? $data->getValidityPeriod() : '-',
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
