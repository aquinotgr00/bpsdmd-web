<?php

namespace App\Http\Controllers\Demand;

use App\Entities\EmployeeCertificate;
use App\Entities\Employee;
use App\Entities\Certificate;
use App\Http\Controllers\Controller;
use App\Services\Domain\EmployeeCertificateService;
use App\Services\Domain\CertificateService;
use App\Services\Domain\EmployeeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class EmployeeCertificateController extends Controller
{
    public function index(EmployeeCertificateService $employeeCertificateService, Employee $employee)
    {
        $page = request()->get('page');
        $data = $employeeCertificateService->paginateEmployeeCertificate(request()->get('page'), $employee);

        //build urls
        $urlCreate = url(route('demand.employeeCertificate.create', [$employee->getId()]));
        $urlUpdate = function($id) use ($employee) {
            return url(route('demand.employeeCertificate.update', [$employee->getId(), $id]));
        };
        $urlDelete = function($id) use ($employee) {
            return url(route('demand.employeeCertificate.delete', [$employee->getId(), $id]));
        };
        $urlDetail = '/employee/'.$employee->getId().'/employee-certificate';
        $urlUpload = url(route('demand.employeeCertificate.upload', [$employee->getId()]));

        return view('employeeCertificate.index', compact('data', 'page', 'employee', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, EmployeeCertificateService $employeeCertificateService, CertificateService $certificateService, Employee $employee)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'validityPeriod' => 'required|date_format:"d-m-Y"',
            ];

            $request->validate($validation, [], [
                'validityPeriod' => ucfirst(trans('common.validity_period')),
            ]);

            $messageBag = new MessageBag;

            $certificate = false;
            if ($request->get('certificate')) {
                $certificate = $certificateService->findById($request->get('certificate'));
            }
            if (!$certificate) {
                $messageBag->add('certificate', trans('common.invalid_certificate'));
                return redirect()->route('demand.employeeCertificate.create', ['employee' => $employee->getId()])->withErrors($messageBag);
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

            return redirect()->route('demand.employeeCertificate.index', ['employee' => $employee->getId()])->with($alert, $message);
        }

        $dataCertificate     = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.create', ['dataCertificate' => $dataCertificate]);
    }

    public function update(Request $request, EmployeeCertificateService $employeeCertificateService, CertificateService $certificateService, Employee $employee, EmployeeCertificate $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'validityPeriod' => 'required|date_format:"d-m-Y"',
            ];

            $request->validate($validation, [], [
                'validityPeriod' => ucfirst(trans('common.validityPeriod')),
            ]);

            $messageBag = new MessageBag;

            $certificate = false;
            if ($request->get('certificate')) {
                $certificate = $certificateService->findById($request->get('certificate'));
            }
            if (!$certificate) {
                $messageBag->add('certificate', trans('common.invalid_certificate'));
                return redirect()->route('demand.employeeCertificate.update', ['employee' => $employee->getId()])->withErrors($messageBag);
            }

            try {
                $employeeCertificateService->update($data, collect($requestData), false, $certificate, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.certificate'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.certificate'))]);
            }

            return redirect()->route('demand.employeeCertificate.index', ['employee' => $employee->getId()])->with($alert, $message);
        }

        $dataCertificate     = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.update', compact('data', 'dataCertificate'));
    }

    public function delete(EmployeeCertificateService $employeeCertificateService, Employee $employee, EmployeeCertificate $data)
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

        return redirect()->route('demand.employeeCertificate.index', ['employee' => $employee->getId()])->with($alert, $message);
    }

    public function ajaxDetailEmployeeCertificate(Request $request, Employee $employee, Certificate $certificate, EmployeeCertificate $data)
    {
        if ($request->ajax()) {
            $data = [
                'employee' => ($data->getEmployee() instanceof Employee) ? $data->getEmployee()->getName() : false,
                'certificate' => ($data->getCertificate() instanceof Certificate) ? $data->getCertificate()->getName() : false,
                'validity_period' => $data->getValidityPeriod() instanceof \DateTime ? $data->getValidityPeriod()->format('d F Y') : '-',
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
