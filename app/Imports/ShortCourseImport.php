<?php

namespace App\Imports;

use EntityManager;
use App\Entities\ShortCourse;
use App\Services\Domain\ShortCourseDataService;
use App\Services\Domain\OrgService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ShortCourseImport implements ToCollection
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

            $orgService = new OrgService;
            $org = $orgService->getRepository()->findOneBy(['name' => $col[4]]);

            $shortCourse = new ShortCourse;
            $shortCourse->setName($col[1]);
            $shortCourse->setType(1);
            $shortCourse->setOrg($org);

            EntityManager::persist($shortCourse);
            EntityManager::flush();

            $subShortCourseData = collect([
              'startDate' => date_format(Date::excelToDateTimeObject($col[8]), 'd-m-Y'),
              'endDate' => date_format(Date::excelToDateTimeObject($col[9]), 'd-m-Y'),
              'totalTarget' => intval($col[5]),
              'totalRealization' => intval($col[6]),
              'openSk' => $col[10],
              'closeSk' => $col[11],
              'generation' => intval($col[2]),
              'year' => intval($col[3]),
              'shortCourseTime' => intval($col[7]),
              'place' => $col[12]
            ]);
            $subShortCourse = new ShortCourseDataService;
            $subShortCourse->create($subShortCourseData, $shortCourse);

            EntityManager::persist($subShortCourse);
            EntityManager::flush();
        }
    }
}
