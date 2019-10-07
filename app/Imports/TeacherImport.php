<?php

namespace App\Imports;

use EntityManager;
use App\Entities\Teacher;
use App\Entities\Organization;
use App\Services\Application\AuthService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TeacherImport implements ToCollection
{
    /** @var sOrganization $org */
    private $org;

    public function setOrg(Organization $org)
    {
        $this->org = $org;
    }

    /**
     * @param array $row
     *
     * @return Teacher|null
     */
    public function collection (Collection $rows)
    {
        foreach ($rows as $key => $row) 
        {
            if($key == 0){
                continue;
            }
            $date_of_birth = gmdate('d-m-Y', (($row[8] - 25569) * 86400));
            $teacher = new Teacher;
            $teacher->setCode($row[0]);
            $teacher->setIdentityNumber($row[1]);
            $teacher->setFrontDegree($row[6]);
            $teacher->setName($row[4]);
            $teacher->setBackDegree($row[7]);
            $teacher->setDateOfBirth(date_create_from_format('d-m-Y', $date_of_birth));
            $teacher->setNip($row[9]);

            if ($this->org instanceof Organization) {
                $teacher->setOrg($this->org);
            }

            EntityManager::persist($teacher);
            EntityManager::flush();
        }
    }
}
