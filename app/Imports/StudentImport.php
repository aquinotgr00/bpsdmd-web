<?php

namespace App\Imports;

use EntityManager;
use App\Entities\Student;
use App\Entities\Organization;
use App\Entities\StudyProgram;
use App\Services\Application\AuthService;
use App\Services\Domain\ProgramService;
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
     * @param array $col
     *
     * @return Student|null
     */
    public function collection (Collection $cols)
    {
        foreach ($cols as $key => $col) 
        {
            if($key == 0){
                continue;
            }

            $studyProgram = null;
            if(!is_null($col[7])){
                $programService = new ProgramService;
                $studyProgram   = $programService->getRepository()->findOneBy(['name' => $col[7], 'org' => $this->org]);
                if ($studyProgram == null) {
                  $data = collect(['code' => substr($col[4], strpos($col[4], "-") + 1), 'name' => $col[7]]);
                  $programService->create($data, $this->org);
                  $studyProgram = $programService->getRepository()->findOneBy(['name' => $col[7]]);
                }
            }

            $student = new Student;
            $student->setCode(substr($col[0], strpos($col[0], "-") + 1));
            $student->setIdentityNumber($col[1]);
            $student->setName($col[2]);
            $student->setPeriod($col[9]);
            $student->setCurriculum($col[11]);
            $student->setStatus($col[13]);
            $student->setClass($col[14]);
            $student->setIpk($col[16]);
            $student->setGraduationYear($col[17]);

            if ($this->org instanceof Organization) {
                $student->setOrg($this->org);
            }
            if ($studyProgram instanceof StudyProgram) {
                $student->setStudyProgram($studyProgram);
            }

            EntityManager::persist($student);
            EntityManager::flush();
        }
    }
}
