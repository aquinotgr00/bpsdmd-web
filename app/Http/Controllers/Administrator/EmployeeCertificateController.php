<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\EmployeeCertificate;
use App\Entities\Employee;
use App\Entities\Certificate;
use App\Entities\Organization;
use App\Imports\EmployeeCertificateImport;
use App\Http\Controllers\Controller;
use App\Services\Application\AuthService;
use App\Services\Domain\EmployeeCertificateService;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\CertificateService;
use App\Services\Domain\FeederService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeCertificateController extends Controller
{
    public function index(EmployeeCertificateService $employeeCertificateService, Organization $org)
    {
        $page = request()->get('page');
        $data = $employeeCertificateService->paginateEmployeeCertificate(request()->get('page'), $org);

        //build urls
        $urlCreate = url(route('administrator.employeeCertificate.create', [$org->getId()]));
        $urlUpdate = function($id) use ($org) {
            return url(route('administrator.employeeCertificate.update', [$org->getId(), $id]));
        };
        $urlDelete = function($id) use ($org) {
            return url(route('administrator.employeeCertificate.delete', [$org->getId(), $id]));
        };
        $urlDetail = '/org/'.$org->getId().'/employee-certificate';
        $urlUpload = url(route('administrator.employeeCertificate.upload', [$org->getId()]));

        return view('employeeCertificate.index', compact('data', 'page', 'org', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, EmployeeCertificateService $employeeCertificateService, EmployeeService $employeeService, CertificateService $certificateService, Organization $org)
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
                return redirect()->route('administrator.employeeCertificate.create', ['org' => $org->getId()])->withErrors($messageBag);
            }
            $certificate = false;
            if ($request->get('certificate')) {
                $certificate = $certificateService->findById($request->get('certificate'));
            }
            if (!$certificate) {
                $messageBag->add('certificate', trans('common.invalid_certificate'));
                return redirect()->route('administrator.employeeCertificate.create', ['org' => $org->getId()])->withErrors($messageBag);
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

            return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId()])->with($alert, $message);
        }

        $dataEmployee       = $employeeService->getRepository()->findBy(['org' => $org->getId()]);
        $dataCertificate    = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.create', ['dataEmployee' => $dataEmployee, 'dataCertificate' => $dataCertificate]);
    }

    public function update(Request $request, EmployeeCertificateService $employeeCertificateService, EmployeeService $employeeService, CertificateService $certificateService, Organization $org, EmployeeCertificate $data)
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
                return redirect()->route('administrator.employeeCertificate.update', ['org' => $org->getId()])->withErrors($messageBag);
            }
            $certificate = false;
            if ($request->get('certificate')) {
                $certificate = $certificateService->findById($request->get('certificate'));
            }
            if (!$certificate) {
                $messageBag->add('certificate', trans('common.invalid_certificate'));
                return redirect()->route('administrator.employeeCertificate.update', ['org' => $org->getId()])->withErrors($messageBag);
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

            return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId(), 'employee' => $employee->getId()])->with($alert, $message);
        }

        $dataEmployee       = $employeeService->getRepository()->findBy(['org' => $org->getId()]);
        $dataCertificate    = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.update', compact('data', 'dataEmployee', 'dataCertificate'));
    }

    public function delete(EmployeeCertificateService $employeeCertificateService, Organization $org, EmployeeCertificate $data)
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

        return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId()])->with($alert, $message);
    }

    public function upload(Request $request, FeederService $feederService, AuthService $authService, Organization $org)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = 'fc_'.$org->getId().'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $idFeeder = $feederService->create(collect($dataFeeder))->getId();

            $importer = new EmployeeCertificateImport;
            $importer->setOrg($org);

            Excel::import($importer, public_path('/excel/'.$nama_file));

            //update status feeder
            $feeder = $feederService->findById($idFeeder);
            $feederService->activeFeeder($feeder);

            $alert = 'alert_success';
            $message = trans('common.feeder_success', ['object' => trans('common.certificate')]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.feeder_failed', ['object' => trans('common.certificate')]);
        }

        return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId()])->with($alert, $message);
    }

    public function ajaxDetailEmployeeCertificate(Request $request, Organization $org, Employee $employee, Certificate $certificate, EmployeeCertificate $data)
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
