<?php

namespace App\Http\Controllers\Demand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Domain\DistrictService;

class DistrictController extends Controller
{
    public function getByName(Request $request, DistrictService $districtService)
    {
        $district = $districtService->findByName($request->q);
        return $district;
    }
}
