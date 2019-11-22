<?php

namespace App\Imports;

use App\Entities\Organization;
use EntityManager;
use App\Entities\ShortCourse;
use App\Services\Domain\ShortCourseDataService;
use App\Services\Domain\OrgService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ShortCourseImport implements ToCollection
{
    /** @var Organization $org */
    private $org;

    public function setOrg(Organization $org)
    {
        $this->org = $org;
    }

    /**
     * @param array $cols
     *
     * @return Diklat|null
     */
    public function collection (Collection $cols)
    {
        foreach ($cols as $key => $col)
        {
            if($key == 0 || is_null($col[2])){
                continue;
            }

            $shortCourse = new ShortCourse;
            $shortCourse->setName($col[1]);
            $shortCourse->setType('teknis');
            $shortCourse->setOrg($this->org);

            EntityManager::persist($shortCourse);
            EntityManager::flush();

            $subShortCourseData = collect([
              'startDate' => date_format(Date::excelToDateTimeObject($col[7]), 'd-m-Y'),
              'endDate' => date_format(Date::excelToDateTimeObject($col[8]), 'd-m-Y'),
              'totalTarget' => intval($col[4]),
              'totalRealization' => intval($col[5]),
              'openSk' => $col[9],
              'closeSk' => $col[10],
              'generation' => intval($col[2]),
              'year' => intval($col[3]),
              'shortCourseTime' => intval($col[6]),
              'place' => $col[12]
            ]);
            $subShortCourse = new ShortCourseDataService;
            $subShortCourse->create($subShortCourseData, $shortCourse);
        }
    }
}
