<?php

namespace App\Entities;

use App\Entities\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TeacherImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return Teacher|null
     */
    public function collection (Collection  $rows)
    {
        foreach ($rows as $row) 
        {
            $teacher = new Teacher;
            $teacher->setId($row[0]);
            $teacher->setIdentityNumber($row[1]);
            $teacher->setOrg($row[3]);
            $teacher->setFrontDegree($row[6]);
            $teacher->setName($row[4]);
            $teacher->setBackDegree($row[7]);
            $teacher->setDateOfBirth($row[8]);
            $teacher->setNip($row[9]);

            EntityManager::persist($teacher);
            EntityManager::flush();

            return $teacher;
        }
    }
}
