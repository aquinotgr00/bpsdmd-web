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
            $teacher = new Student;
            $teacher->setCode(substr($row[0], strpos($row[0], "-") + 1));
            $teacher->setIdentityNumber($row[1]);
            $teacher->setName($row[2]);
            $teacher->setPeriod($row[9]);
            $teacher->setCurriculum($row[11]);
            $teacher->setStatus($row[13]);
            $teacher->setClass($row[14]);
            $teacher->setIpk($row[16]);
            $teacher->setGraduationYear($row[17]);

            
            $authService = new AuthService();
            $org = $authService->user()->getOrg();
            if ($org instanceof Organization) {
                $teacher->setOrg($org);
            }

            EntityManager::persist($teacher);
            EntityManager::flush();
        }
    }
}
