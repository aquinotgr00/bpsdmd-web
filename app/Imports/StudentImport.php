<?php

namespace App\Imports;

use EntityManager;
use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Services\Application\AuthService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
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
     * @return Student|null
     */
    public function collection (Collection $rows)
    {
        foreach ($rows as $key => $row) 
        {
            if($key == 0){
                continue;
            }
            $student = new Student;
            $student->setCode(substr($row[0], strpos($row[0], "-") + 1));
            $student->setIdentityNumber($row[1]);
            $student->setName($row[2]);
            $student->setPeriod($row[9]);
            $student->setCurriculum($row[11]);
            $student->setStatus($row[13]);
            $student->setClass($row[14]);
            $student->setIpk($row[16]);
            $student->setGraduationYear($row[17]);

            if ($this->org instanceof Organization) {
                $student->setOrg($this->org);
            }

            EntityManager::persist($student);
            EntityManager::flush();
        }
    }
}
