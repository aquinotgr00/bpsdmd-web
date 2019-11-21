<?php

namespace App\Imports;

use EntityManager;
use App\Entities\Teacher;
use App\Entities\Organization;
use App\Services\Application\AuthService;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeacherImport implements ToCollection
{
    /** @var Organization $org */
    private $org;

    /** @var array $errors */
    private $errors = [];

    public function setOrg(Organization $org)
    {
        $this->org = $org;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param int $line
     */
    public function setErrors($line): void
    {
        $this->errors[] = $line;
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

            try {
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
            } catch (Exception $e) {
                $this->setErrors($key);
                continue;
            }
        }
    }
}
