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
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentImport implements ToCollection
{
    /** @var Organization $org */
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
            if($key == 0 || is_null($col[5])){
                continue;
            }

            $studyProgram = null;
            if(!is_null($col[3])){
                $programService = new ProgramService;
                $studyProgram   = $programService->getRepository()->findOneBy(['name' => $col[3], 'org' => $this->org]);
                if ($studyProgram == null) {
                  $data = collect(['code' => substr($col[0], strpos($col[0], "-") + 1), 'name' => $col[3]]);
                  $programService->create($data, [], $this->org);
                  $studyProgram = $programService->getRepository()->findOneBy(['name' => $col[3]]);
                }
            }

            $student = new Student;
            $student->setIdDikti($col[1]);
            $student->setNim($col[4]);
            $student->setName($col[5]);
            $student->setGender($col[6]);
            $student->setPlaceOfBirth($col[7]);
            $student->setAddress($col[9]);
            $student->setPhoneNumber($col[10]);
            $student->setMobilePhoneNumber($col[11]);
            $student->setEmail($col[12]);
            $student->setReligion($col[13]);
            $student->setMotherName($col[14]);
            $student->setNationality($col[15]);
            $student->setForeignCitizen($col[16]);
            $student->setSocialProtectionCard($col[17]);
            $student->setOccupationType($col[18]);
            $student->setIdentityNumber($col[19]);
            $student->setStartSemester((int)$col[22]);
            $student->setCurrentSemester((int)$col[23]);
            $student->setStudentCredits((int)$col[24]);
            $student->setIpk($col[25]);
            $student->setCertificateNumber($col[26]);
            $student->setEnrollmentType($col[28]);
            $student->setGraduationType($col[29]);
            $student->setPeriod($col[31]);
            $student->setCurriculum($col[32]);
            $student->setStatus($col[33]);
            $student->setGraduationYear($col[34]);

            if ($col[8]) {
                $student->setDateOfBirth(date_format(Date::excelToDateTimeObject($col[8]), 'd-m-Y'));
            }
            if ($col[20]) {
                $student->setEnrollmentDateStart(date_format(Date::excelToDateTimeObject($col[20]), 'd-m-Y'));
            }
            if ($col[21]) {
                $student->setEnrollmentDateEnd(date_format(Date::excelToDateTimeObject($col[21]), 'd-m-Y'));
            }
            if ($col[27]) {
                $student->setGraduationJudgementDate(date_format(Date::excelToDateTimeObject($col[27]), 'd-m-Y'));
            }
            if ($col[30]) {
                $student->setLastUpdate(date_format(Date::excelToDateTimeObject($col[30]), 'd-m-Y'));
            }

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
