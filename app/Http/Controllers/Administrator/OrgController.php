<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\Organization;
use App\Http\Controllers\Controller;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\OrgDeleteException;
use Image;

class OrgController extends Controller
{
    public function supply(OrgService $orgService)
    {
        $page = request()->get('page');
        $data = $orgService->paginateOrgSupply(request()->get('page'));

        return view('org.supply', compact('data', 'page'));
    }

    public function demand(OrgService $orgService)
    {
        $page = request()->get('page');
        $data = $orgService->paginateOrgDemand(request()->get('page'));

        return view('org.demand', compact('data', 'page'));
    }

    public function create(Request $request, OrgService $orgService)
    {
        $moda = [
            Organization::MODA_KERETA => ucfirst(Organization::MODA_KERETA),
            Organization::MODA_DARAT => ucfirst(Organization::MODA_DARAT),
            Organization::MODA_LAUT => ucfirst(Organization::MODA_LAUT),
            Organization::MODA_UDARA => ucfirst(Organization::MODA_UDARA)
        ];
        $accreditation = [
            Organization::ACCREDITATION_A => ucfirst(Organization::ACCREDITATION_A),
            Organization::ACCREDITATION_B => ucfirst(Organization::ACCREDITATION_B),
            Organization::ACCREDITATION_C => ucfirst(Organization::ACCREDITATION_C),
            Organization::ACCREDITATION_NA => ucfirst(Organization::ACCREDITATION_NA)
        ];

        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND,
                'moda' => 'required|in:'.implode(',', array_flip($moda)),
                'accreditation' => 'required|in:'.implode(',', array_flip($accreditation)),
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'type' => ucfirst(trans('common.type')),
                'moda' => ucfirst(trans('common.moda')),
                'accreditation' => ucfirst(trans('common.accreditation')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Organization::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $orgService->create(collect($requestData));
                $alert = 'alert_success';
                $message = trans('common.create_success', ['object' => ucfirst(trans('common.institute'))]);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => ucfirst(trans('common.institute'))]);
            }

            if( $request->input('type') == 'supply' ) {
                return redirect()->route('administrator.org.supply')->with($alert, $message);
            } else {
                return redirect()->route('administrator.org.demand')->with($alert, $message);
            }
        }

        return view('org.create');
    }

    public function update(Request $request, OrgService $orgService, Organization $data)
    {
        $moda = [
            Organization::MODA_KERETA => ucfirst(Organization::MODA_KERETA),
            Organization::MODA_DARAT => ucfirst(Organization::MODA_DARAT),
            Organization::MODA_LAUT => ucfirst(Organization::MODA_LAUT),
            Organization::MODA_UDARA => ucfirst(Organization::MODA_UDARA)
        ];
        $accreditation = [
            Organization::ACCREDITATION_A => ucfirst(Organization::ACCREDITATION_A),
            Organization::ACCREDITATION_B => ucfirst(Organization::ACCREDITATION_B),
            Organization::ACCREDITATION_C => ucfirst(Organization::ACCREDITATION_C),
            Organization::ACCREDITATION_NA => ucfirst(Organization::ACCREDITATION_NA)
        ];

        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'type' => 'required|in:' . Organization::TYPE_SUPPLY . ',' . Organization::TYPE_DEMAND,
                'moda' => 'required|in:'.implode(',', array_flip($moda)),
                'accreditation' => 'required|in:'.implode(',', array_flip($accreditation)),
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540'
            ];

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'type' => ucfirst(trans('common.type')),
                'moda' => ucfirst(trans('common.moda')),
                'accreditation' => ucfirst(trans('common.accreditation')),
                'photo' => ucfirst(trans('common.photo')),
            ]);

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(Organization::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $orgService->update($data, collect($requestData), true);
                $alert = 'alert_success';
                $message = trans('common.update_success', ['object' => ucfirst(trans('common.institute'))]);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => ucfirst(trans('common.institute'))]);
            }

            if( $request->input('type') == 'supply' ) {
                return redirect()->route('administrator.org.supply')->with($alert, $message);
            } else {
                return redirect()->route('administrator.org.demand')->with($alert, $message);
            }
        }

        return view('org.update', compact('data'));
    }

    public function delete(OrgService $orgService, Organization $data)
    {
        try {
            $orgService->delete($data);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => ucfirst(trans('common.institute'))]);
        } catch (OrgDeleteException $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.institute'))]);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => ucfirst(trans('common.institute'))]);
        }

        if( $data->getType() == 'supply') {
            return redirect()->route('administrator.org.supply')->with($alert, $message);
        } else {
            return redirect()->route('administrator.org.demand')->with($alert, $message);
        }
    }

    public function ajaxDetailOrg(Request $request, Organization $org)
    {
        if ($request->ajax()) {
            $data = [
                'id_dikti' => $org->getIdDikti() ? $org->getIdDikti() : '-',
                'code' => $org->getCode() ? $org->getCode() : '-',
                'name' => $org->getName(),
                'short_name' => $org->getShortName() ? $org->getShortName() : '-',
                'letter_of_est' => $org->getLetterOfEst() ? $org->getLetterOfEst() : '-',
                'date_of_est' => $org->getDateOfEst() instanceof \DateTime ? $org->getDateOfEst()->format('d F Y') : '-',
                'letter_of_opr' => $org->getLetterOfOpr() ? $org->getLetterOfOpr() : '-',
                'date_of_opr' => $org->getDateOfOpr() instanceof \DateTime ? $org->getDateOfOpr()->format('d F Y') : '-',
                'status' => $org->getStatus() ? $org->getStatus() : '-',
                'type' => ucfirst($org->getType()),
                'moda' => ucfirst($org->getModa()),
                'address' => $org->getAddress() ? $org->getAddress() : '-',
                'description' => $org->getDescription() ? $org->getDescription() : '-',
                'phone_number' => $org->getPhoneNumber() ? $org->getPhoneNumber() : '-',
                'fax' => $org->getFax() ? $org->getFax() : '-',
                'website' => $org->getWebsite() ? $org->getWebsite() : '-',
                'email' => $org->getEmail() ? $org->getEmail() : '-',
                'ownership_status' => $org->getOwnershipStatus() ? $org->getOwnershipStatus() : '-',
                'under_supervision' => $org->getUnderSupervision() ? $org->getUnderSupervision() : '-',
                'education_type' => $org->getEducationType() ? $org->getEducationType() : '-',
                'accreditation' => $org->getStatus() ? $org->getStatus() : '-',
                'photo' => $org->getLogo() ? url(url(Organization::UPLOAD_PATH.'/'.$org->getLogo())) : url('img/avatar.png'),
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
