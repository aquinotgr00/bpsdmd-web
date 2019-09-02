<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\Domain\MatchService;
use Illuminate\Database\Query\Expression;

class LinkAndMatchController extends Controller
{
	public function indexAdmin()
	{ 
		$unit = DB::table('public.dataref_msunit as msunit')
		->selectRaw('msunit.*, msunit.idunit as id, msunit.parentunit as parent_id')
		->where(new Expression('LENGTH(msunit.idunit)'),'<=',10)->get();

		$unit = buildTree((array) json_decode($unit,true));

		return view('link_and_match.index',['unit' => $unit]);
	}

	public function getProdiByInstansi(Request $request)
	{
		$units = DB::table('public.dataref_msunit as msunit')
		->where('msunit.parentunit',$request->get('unit'))->get();

		$prodi_view = view('link_and_match.ajax_content.prodi',[
			'instansi' => $request->get('namaunit'),
			'units' => (array) json_decode($units,true)
		])->render();
		
		if (count($units) > 0) {
			return response()->json(['status' => 200,'prodi' => $prodi_view]);
		}
		return response()->json(['status' => 404,'message' => 'Prodi Tidak Ditemukan']);
	}

	public function getKompetensiByProdi(Request $request)
	{
		$kompetensi = DB::table('public.dataref_lisensi_ref as lisensi')
		->selectRaw('lisensi.nama,lisensi.bab, lisensi.no as id, lisensi.parent as parent_id')
		->leftJoin('public.relasi_lisensi as relasi_lisensi', function($join)
		{
			$join->on('lisensi.bab', '=', 'relasi_lisensi.bab');
			$join->on('lisensi.no', '=', 'relasi_lisensi.no');
		})
		->where('relasi_lisensi.jur',$request->get('prodi'))
		->groupBy('lisensi.no','lisensi.bab','lisensi.nama','lisensi.parent')
		->get();
		
		$kompetensi_view = view('link_and_match.ajax_content.kompetensi',[
			'instansi' => $request->get('namaunit'),
			'kompetensi' => buildTree((array) json_decode($kompetensi,true))
		])->render();
		
		if (count($kompetensi) > 0) {
			return response()->json(['status' => 200,'kompetensi' => $kompetensi_view]);
		}

		return response()->json(['status' => 404,'message' => 'Kompetensi Tidak Ditemukan']);

	}
	public function getDemandByKompetensi(Request $request, MatchService $matchService)
	{
		$lisensi = $matchService->getChildLisensi(collect($request->all()));
		
		$jobs = DB::table('demand.relasi_job_lisensi as job_lisensi')
		->join('demand.ref_job_title', "job_lisensi.id_job_title",'=','ref_job_title.id_job_title')
		->join('public.datauser', "datauser.iduser",'=','ref_job_title.id_user_demand')
		->leftJoin('public.dataref_msunit', "dataref_msunit.idunit",'=','datauser.org')
		->selectRaw('job_lisensi.job_title, job_lisensi.lisensi, datauser.name, dataref_msunit.namaunit')
		->get()->toArray();

		$match_demand = [];
		foreach ($lisensi as $item) {
			if ($job_key = array_search($item->id_dataref_lisensi_ref, array_column($jobs, 'lisensi'))) {
				$match_demand[$jobs[$job_key]->name] = $jobs[$job_key];
				$match_demand[$jobs[$job_key]->name]->match[] = $item;
			}
		}

		if (count($match_demand) > 0) {
			$demand_view = view('link_and_match.ajax_content.demand',[
				'demand' => $match_demand,
				'kompetensi' => $lisensi,
			])->render();
			return response()->json(['status' => 200,'demand' => $demand_view]);
		}

		return response()->json(['status' => 404,'message' => 'Demand Tidak Ditemukan']);
	}
}
