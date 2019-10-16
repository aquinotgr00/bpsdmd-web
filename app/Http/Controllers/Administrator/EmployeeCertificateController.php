<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\EmployeeCertificate;
use App\Entities\Employee;
use App\Entities\Certificate;
use App\Entities\Organization;
use App\Imports\EmployeeCertificateImport;
use App\Http\Controllers\Controller;
use App\Services\Domain\EmployeeCertificateService;
use App\Services\Domain\CertificateService;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\FeederService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class EmployeeCertificateController extends Controller
{
    public function index(EmployeeCertificateService $employeeCertificateService, Organization $org, Employee $employee)
    {
        $page = request()->get('page');
        $data = $employeeCertificateService->paginateEmployeeCertificate(request()->get('page'), $employee);

        //build urls
        $urlCreate = url(route('administrator.employeeCertificate.create', [$org->getId(), $employee->getId()]));
        $urlUpdate = function($id) use ($employee) {
            return url(route('administrator.employeeCertificate.update', [$org->getId(), $employee->getId(), $id]));
        };
        $urlDelete = function($id) use ($employee) {
            return url(route('administrator.employeeCertificate.delete', [$org->getId(), $employee->getId(), $id]));
        };
        $urlDetail = '/org/'.$org->getId().'/employee/'.$employee->getId().'/employeeCertificate';
        $urlUpload = url(route('administrator.employeeCertificate.upload', [$org->getId(), $employee->getId()]));

        return view('employeeCertificate.index', compact('data', 'page', 'employee', 'urlCreate', 'urlUpdate', 'urlDelete', 'urlDetail', 'urlUpload'));
    }

    public function create(Request $request, EmployeeCertificateService $employeeCertificateService, CertificateService $certificateService, Organization $org, Employee $employee)
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
                return redirect()->route('administrator.employeeCertificate.create', ['org' => $org->getId(), 'employee' => $employee->getId()])->withErrors($messageBag);
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

            return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId(), 'employee' => $employee->getId()])->with($alert, $message);
        }

        $dataCertificate     = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.create', ['dataCertificate' => $dataCertificate]);
    }

    public function update(Request $request, EmployeeCertificateService $employeeCertificateService, CertificateService $certificateService, Organization $org, Employee $employee, EmployeeCertificate $data)
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
                return redirect()->route('administrator.employeeCertificate.update', ['org' => $org->getId(), 'employee' => $employee->getId()])->withErrors($messageBag);
            }

            try {
                $employeeCertificateService->update($data, collect($requestData), false, $certificate, true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.certificate'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.certificate'))]);
            }

            return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId(), 'employee' => $employee->getId()])->with($alert, $message);
        }

        $dataCertificate     = $certificateService->getRepository()->findAll();

        return view('employeeCertificate.update', compact('data', 'dataCertificate'));
    }

    public function delete(EmployeeCertificateService $employeeCertificateService, Organization $org, Employee $employee, EmployeeCertificate $data)
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

        return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId(), 'employee' => $employee->getId()])->with($alert, $message);
    }

    public function upload(Request $request, FeederService $feederService, AuthService $authService, Organization $org, Employee $employee)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = 'fs_'.$employee->getId().'_'.rand().'_'.$file->getClientOriginalName();
        $file->move('excel', $nama_file);

        try {
            //insert feeder
            $dataFeeder = ['filename' => $nama_file, 'user' => $authService->user()];
            $idFeeder = $feederService->create(collect($dataFeeder))->getId();

            $importer = new EmployeeCertificateImport;
            $importer->setEmployee($employee);

            Excel::import($importer, public_path('/excel/'.$nama_file));

            //update status feeder
            $feeder = $feederService->findById($idFeeder);
            $feederService->activeFeeder($feeder);

            $alert = 'alert_success';
            $message = trans('common.feeder_success', ['object' => trans('common.student')]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.feeder_failed', ['object' => trans('common.student')]);
        }

        return redirect()->route('administrator.employeeCertificate.index', ['org' => $org->getId(), 'employee' => $employee->getId()])->with($alert, $message);
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
