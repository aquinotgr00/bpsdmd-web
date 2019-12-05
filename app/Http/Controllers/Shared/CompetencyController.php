<?php

namespace App\Http\Controllers\Shared;

use App\Entities\Competency;
use App\Entities\CompetencyKeyFunction;
use App\Entities\CompetencyMainFunction;
use App\Entities\CompetencyMainPurpose;
use App\Entities\CompetencyUnit;
use App\Http\Controllers\Controller;
use App\Services\Domain\CompetencyKeyFunctionService;
use App\Services\Domain\CompetencyMainFunctionService;
use App\Services\Domain\CompetencyMainPurposeService;
use App\Services\Domain\CompetencyService;
use App\Services\Domain\CompetencyUnitService;
use App\Services\Domain\LicenseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class CompetencyController extends Controller
{
    public function index(CompetencyService $competencyService)
    {
        $page = request()->get('page');
        $data = $competencyService->paginateCompetency(request()->get('page'));

        return view('competency.index', compact('data', 'page'));
    }

    public function create(Request $request,
        CompetencyService $competencyService,
        CompetencyKeyFunctionService $ckfService,
        CompetencyMainFunctionService $cmfService,
        CompetencyMainPurposeService $cmpService,
        CompetencyUnitService $cuService,
        LicenseService $licenseService
    )
    {
        $licenses = $licenseService->getAsList($request->input('license', []));

        $ckf = false;
        $cmf = false;
        $cmp = false;
        $cu = false;
        $moda = [
            Competency::MODA_KERETA => ucfirst(Competency::MODA_KERETA),
            Competency::MODA_DARAT => ucfirst(Competency::MODA_DARAT),
            Competency::MODA_LAUT => ucfirst(Competency::MODA_LAUT),
            Competency::MODA_UDARA => ucfirst(Competency::MODA_UDARA)
        ];

        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'moda' => 'required|in:'.implode(',', array_flip($moda)),
                'ckf' => 'required',
                'cmf' => 'required',
                'cmp' => 'required',
                'cu' => 'required'
            ], [], [
                'name' => ucfirst(trans('common.name')),
                'type' => ucfirst(trans('common.type')),
                'ckf' => ucfirst(trans('common.competency_key_function')),
                'cmf' => ucfirst(trans('common.competency_main_function')),
                'cmp' => ucfirst(trans('common.competency_main_purpose')),
                'cu' => ucfirst(trans('common.competency_unit'))
            ]);

            $messageBag = new MessageBag;

            if ($request->get('ckf')) {
                $ckf = $ckfService->getRepository()->find($request->get('ckf'));

                if (!$ckf instanceof CompetencyKeyFunction) {
                    $messageBag->add('ckf', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_key_function'))]));
                }
            }

            if ($request->get('cmf')) {
                $cmf = $cmfService->getRepository()->find($request->get('cmf'));

                if (!$cmf instanceof CompetencyMainFunction) {
                    $messageBag->add('cmf', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_main_function'))]));
                }
            }

            if ($request->get('cmp')) {
                $cmp = $cmpService->getRepository()->find($request->get('cmp'));

                if (!$cmp instanceof CompetencyMainPurpose) {
                    $messageBag->add('cmp', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_main_purpose'))]));
                }
            }

            if ($request->get('cu')) {
                $cu = $cuService->getRepository()->find($request->get('cu'));

                if (!$cu instanceof CompetencyUnit) {
                    $messageBag->add('cu', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_unit'))]));
                }
            }

            if ($messageBag->count() > 0) {
                return redirect()->route('shared.competency.create')->withErrors($messageBag);
            }

            try {
                $competencyService->create($ckf, $cmf, $cmp, $cu, collect($request->all()));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.competency_unit'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.competency_unit'))]);
            }

            return redirect()->route('shared.competency.index')->with($alert, $message);
        }

        $ckf = $ckfService->getRepository()->findAll();
        $cmf = $cmfService->getRepository()->findAll();
        $cmp = $cmpService->getRepository()->findAll();
        $cu = $cuService->getRepository()->findAll();

        return view('competency.create', compact('licenses','moda', 'ckf', 'cmf', 'cmp', 'cu'));
    }

    public function update(Request $request,
        CompetencyService $competencyService,
        CompetencyKeyFunctionService $ckfService,
        CompetencyMainFunctionService $cmfService,
        CompetencyMainPurposeService $cmpService,
        CompetencyUnitService $cuService,
        LicenseService $licenseService,
        Competency $competency
    )
    {
        $licenses = $licenseService->getAsList($competency->getLicenseCompetency());
        $ckf = false;
        $cmf = false;
        $cmp = false;
        $cu = false;
        $moda = [
            Competency::MODA_KERETA => ucfirst(Competency::MODA_KERETA),
            Competency::MODA_DARAT => ucfirst(Competency::MODA_DARAT),
            Competency::MODA_LAUT => ucfirst(Competency::MODA_LAUT),
            Competency::MODA_UDARA => ucfirst(Competency::MODA_UDARA)
        ];

        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'moda' => 'required|in:'.implode(',', array_flip($moda)),
                'ckf' => 'required',
                'cmf' => 'required',
                'cmp' => 'required',
                'cu' => 'required'
            ], [], [
                'name' => ucfirst(trans('common.name')),
                'text' => ucfirst(trans('common.unit')),
                'ckf' => ucfirst(trans('common.competency_key_function')),
                'cmf' => ucfirst(trans('common.competency_main_function')),
                'cmp' => ucfirst(trans('common.competency_main_purpose')),
                'cu' => ucfirst(trans('common.competency_unit'))
            ]);

            $messageBag = new MessageBag;

            if ($request->get('ckf')) {
                $ckf = $ckfService->getRepository()->find($request->get('ckf'));

                if (!$ckf instanceof CompetencyKeyFunction) {
                    $messageBag->add('ckf', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_unit'))]));
                }
            }

            if ($request->get('cmf')) {
                $cmf = $cmfService->getRepository()->find($request->get('cmf'));

                if (!$cmf instanceof CompetencyMainFunction) {
                    $messageBag->add('cmf', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_main_function'))]));
                }
            }

            if ($request->get('cmp')) {
                $cmp = $cmpService->getRepository()->find($request->get('cmp'));

                if (!$cmp instanceof CompetencyMainPurpose) {
                    $messageBag->add('cmp', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_main_purpose'))]));
                }
            }

            if ($request->get('cu')) {
                $cu = $cuService->getRepository()->find($request->get('cu'));

                if (!$cu instanceof CompetencyUnit) {
                    $messageBag->add('cu', trans('common.invalid_option', ['object' => ucwords(trans('common.competency_unit'))]));
                }
            }

            if ($messageBag->count() > 0) {
                return redirect()->back()->withErrors($messageBag);
            }

            try {
                $competencyService->update($competency, $ckf, $cmf, $cmp, $cu, collect($request->input()));
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.competency_unit'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.competency_unit'))]);
            }

            return redirect()->route('shared.competency.index')->with($alert, $message);
        }

        $ckf = $ckfService->getRepository()->findAll();
        $cmf = $cmfService->getRepository()->findAll();
        $cmp = $cmpService->getRepository()->findAll();
        $cu = $cuService->getRepository()->findAll();

        return view('competency.update', compact('competency', 'licenses', 'moda', 'ckf', 'cmf', 'cmp', 'cu'));
    }

    public function delete(CompetencyService $competencyService, Competency $competency)
    {
        try {
            $competencyService->delete($competency);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.competency_unit'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.competency_unit'))]);
        }

        return redirect()->route('shared.competency.index')->with($alert, $message);
    }

    public function ajaxDetailCompetency(Request $request, Competency $competency)
    {
        if ($request->ajax()) {
            $license = '';

            foreach ($competency->getLicenseCompetency() as $item) {
                $license .= $item->getLicense()->getCode().' '.$item->getLicense()->getChapter().' - '.$item->getLicense()->getName().'<br>';
            }

            $data = [
                'name' => ucwords($competency->getName()),
                'moda' => ucwords($competency->getModa()),
                'type' => $competency->getType(),
                'ckf' => $competency->getCompetencyKeyFunction()->getKeyFunction(),
                'cmp' => $competency->getCompetencyMainPurpose()->getMainPurpose(),
                'cmf' => $competency->getCompetencyMainFunction()->getMainFunction(),
                'cu' => $competency->getCompetencyUnit()->getCompetency(),
                'license' => $license,
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
