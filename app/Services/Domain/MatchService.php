<?php

namespace App\Services\Domain;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;

class MatchService
{
	public function getChildLisensi(Collection $data)
	{
		return DB::select("
			WITH RECURSIVE childs AS
			(
			    SELECT 
			        t1.no, 
			        t1.nama, 
			        t1.bab,
					t1.parent,
					t1.id_dataref_lisensi_ref
			    FROM 
			        dataref_lisensi_ref t1
			    WHERE 
			        t1.no = ? AND
					t1.bab = ?
			    UNION ALL
			    SELECT 
			       	t2.no, 
			       	t2.nama, 
			       	t2.bab,
				 	t2.parent,
					t2.id_dataref_lisensi_ref
			    FROM 
			        dataref_lisensi_ref t2 
			    INNER JOIN 
			        childs ON childs.no = t2.parent
					where
					t2.bab = ?
			)
			SELECT
			    no as id,
			    parent as parent_id,
			    bab,
				nama,
				id_dataref_lisensi_ref
			 FROM
			    childs;
		",[
			$data->get('id'),
			$data->get('bab'),
			$data->get('bab'),
		]);
	}
}
