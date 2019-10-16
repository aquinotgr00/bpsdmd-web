<?php

namespace App\Http\Controllers\Demand;

use App\Entities\Certificate;
use App\Http\Controllers\Controller;
use App\Services\Domain\CertificateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

class CertificateController extends Controller
{
    public function index(CertificateService $certificateService)
    {
        $page = request()->get('page');
        $data = $certificateService->paginateCertificate(request()->get('page'));

        //build urls
        $urlCreate = url(route('demand.certificate.create'));
        $urlUpdate = function($id) {
            return url(route('demand.certificate.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('demand.certificate.delete', [$id]));
        };

        return view('certificate.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, CertificateService $certificateService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $certificateService->create(collect($requestData));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.certificate'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.certificate'))]);
            }

            return redirect()->route('demand.certificate.index')->with($alert, $message);
        }

        return view('certificate.create');
    }

    public function update(Request $request, CertificateService $certificateService, Certificate $data)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
            ]);

            try {
                $requestData = $request->all();

                $certificateService->update($data, collect($requestData), true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.certificate'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.certificate'))]);
            }

            return redirect()->route('demand.certificate.index')->with($alert, $message);
        }

        return view('certificate.update', compact('data'));
    }

    public function delete(CertificateService $certificateService, Certificate $data)
    {
        try {
            $certificateService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.certificate'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.certificate'))]);
        }

        return redirect()->route('demand.certificate.index')->with($alert, $message);
    }
}
