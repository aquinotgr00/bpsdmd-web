<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\License;
use App\Http\Controllers\Controller;
use App\Services\Domain\CompetencyService;
use App\Services\Domain\LicenseService;
use Exception;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index(LicenseService $licenseService)
    {
        $page = request()->get('page');
        $data = $licenseService->paginateLicense(request()->get('page'));

        //build urls
        $urlCreate = url(route('administrator.license.create'));
        $urlUpdate = function($id) {
            return url(route('administrator.license.update', [$id]));
        };
        $urlDelete = function($id) {
            return url(route('administrator.license.delete', [$id]));
        };

        return view('license.index', compact('data', 'page', 'urlCreate', 'urlUpdate', 'urlDelete'));
    }

    public function create(Request $request, LicenseService $licenseService, CompetencyService $competencyService)
    {
        $competencies = $competencyService->getAsList($request->input('competency', []));

        $moda = [
            License::MODA_KERETA => ucfirst(License::MODA_KERETA),
            License::MODA_DARAT => ucfirst(License::MODA_DARAT),
            License::MODA_LAUT => ucfirst(License::MODA_LAUT),
            License::MODA_UDARA => ucfirst(License::MODA_UDARA)
        ];
        $heads = $licenseService->getHeadAsArray();

        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'name' => 'required',
                'chapter' => 'required',
                'moda' => 'required|in:'.implode(',', array_flip($moda))
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
                'chapter' => ucfirst(trans('common.chapter')),
                'moda' => ucfirst(trans('common.moda')),
            ]);

            try {
                $licenseService->create(collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.license'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.license'))]);
            }

            return redirect()->route('administrator.license.index')->with($alert, $message);
        }

        return view('license.create', compact('moda', 'heads', 'competencies'));
    }

    public function update(Request $request, LicenseService $licenseService, CompetencyService $competencyService, License $license)
    {
        $competencies = $competencyService->getAsList($license->getLicenseCompetency());

        $moda = [
            License::MODA_KERETA => ucfirst(License::MODA_KERETA),
            License::MODA_DARAT => ucfirst(License::MODA_DARAT),
            License::MODA_LAUT => ucfirst(License::MODA_LAUT),
            License::MODA_UDARA => ucfirst(License::MODA_UDARA)
        ];
        $heads = $licenseService->getHeadAsArray();

        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',
                'name' => 'required',
                'chapter' => 'required',
                'moda' => 'required|in:'.implode(',', array_flip($moda))
            ], [], [
                'code' => ucfirst(trans('common.code')),
                'name' => ucfirst(trans('common.name')),
                'chapter' => ucfirst(trans('common.chapter')),
                'moda' => ucfirst(trans('common.moda')),
            ]);

            try {
                $licenseService->update($license, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.license'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.license'))]);
            }

            return redirect()->route('administrator.license.index')->with($alert, $message);
        }

        return view('license.update', compact('license', 'moda', 'heads', 'competencies'));
    }

    public function delete(LicenseService $licenseService, License $license)
    {
        try {
            $licenseService->delete($license);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.license'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.license'))]);
        }

        return redirect()->route('administrator.license.index')->with($alert, $message);
    }

    public function ajaxDetailLicense(Request $request, License $license)
    {
        if ($request->ajax()) {
            $competency = '';

            foreach ($license->getLicenseCompetency() as $item) {
                $competency .= ucfirst($item->getCompetency()->getModa()).' '.$item->getCompetency()->getType().' - '.$item->getCompetency()->getName().'<br>';
            }

            $data = [
                'name' => ucwords($license->getCode().' '.$license->getChapter().' - '.$license->getName()),
                'moda' => ucwords($license->getModa()),
                'head' => $license->getHead(),
                'competency' => $competency,
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
