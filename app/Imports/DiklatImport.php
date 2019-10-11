<?php

namespace App\Imports;

use App\Entities\DataDiklat;
use EntityManager;
use App\Entities\Diklat;
use App\Entities\Organization;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DiklatImport implements ToCollection
{
    /**
     * @param array $cols
     *
     * @return Diklat|null
     */
    public function collection (Collection $cols)
    {
        foreach ($cols as $key => $col) 
        {
            if($key == 0){
                continue;
            }
            $org = Organization::where('name', $col[4])->first();
            $diklat = new Diklat;
            $diklat->setOrg($org);
            $diklat->setName($col[1]);
            $diklat->setType(1);

            $data_diklat = new DataDiklat;
            $data_diklat->setDiklat($diklat);
            $data_diklat->setStartDate($col[8]);
            $data_diklat->setEndDate($col[9]);
            $data_diklat->setTotalTarget($col[5]);
            $data_diklat->setTotalRealization($col[6]);
            $data_diklat->setSkBuka($col[10]);
            $data_diklat->setSkTutup($col[11]);
            $data_diklat->setGeneration($col[2]);
            $data_diklat->setYear($col[3]);
            $data_diklat->setPeriod($col[7]);
            $data_diklat->setPlace($col[12]);

            EntityManager::persist($diklat);
            EntityManager::persist($data_diklat);
            EntityManager::flush();
        }
    }
}
