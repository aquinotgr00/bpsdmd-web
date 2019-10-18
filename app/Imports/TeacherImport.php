<?php

namespace App\Imports;

use EntityManager;
use App\Entities\Teacher;
use App\Entities\Organization;
use App\Services\Application\AuthService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeacherImport implements ToCollection
{
    /** @var sOrganization $org */
    private $org;

    public function setOrg(Organization $org)
    {
        $this->org = $org;
    }

    /**
     * @param array $col
     *
     * @return Teacher|null
     */
    public function collection (Collection $cols)
    {
        foreach ($cols as $key => $col) 
        {
            if($key == 0){
                continue;
            }

            $teacher = new Teacher;
            $teacher->setCode($col[0]);
            $teacher->setIdentityNumber($col[1]);
            $teacher->setFrontDegree($col[6]);
            $teacher->setName($col[4]);
            $teacher->setBackDegree($col[7]);
            $teacher->setDateOfBirth(Date::excelToDateTimeObject($col[8]), 'd-m-Y');
            $teacher->setNip($col[9]);

            if ($this->org instanceof Organization) {
                $teacher->setOrg($this->org);
            }

            EntityManager::persist($teacher);
            EntityManager::flush();
        }
    }
}
