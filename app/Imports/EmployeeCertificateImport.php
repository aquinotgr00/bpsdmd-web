<?php

namespace App\Imports;

use EntityManager;
use App\Entities\EmployeeCertificate;
use App\Entities\Organization;
use App\Entities\Employee;
use App\Entities\Certificate;
use App\Services\Application\AuthService;
use App\Services\Domain\EmployeeService;
use App\Services\Domain\OrgService;
use App\Services\Domain\CertificateService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeCertificateImport implements ToCollection
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
            if($key == 0 || is_null($col[0]) || is_null($col[1]) || is_null($col[10]) || is_null($col[14])){
                continue;
            }

            $employee = null;
            if(!is_null($col[0]) && !is_null($col[1])){
                $employeeService = new EmployeeService;
                $employee        = $employeeService->getRepository()->findOneBy(['identityNumber' => $col[1]]);
                if ($employee == null) {

                    //create school
                    $school = null;
                    if(!is_null($col[10])){
                        $orgService = new OrgService;
                        $school     = $orgService->getRepository()->findOneBy(['name' => $col[10]]);
                        if ($school == null) {
                            $orgService->create(collect(['name' => $col[10]]));
                            $school = $orgService->getRepository()->findOneBy(['name' => $col[10]]);
                        }
                    }

                    $data = collect([
                        'code' => intval($col[0]), 
                        'identity_number' => intval($col[1]), 
                        'name' => $col[3],
                        'dateOfBirth' => date_format(Date::excelToDateTimeObject($col[4]), 'd-m-Y'),
                        'language' => $col[5],
                        'nationality' => $col[6],
                        'gender' => $col[7],
                        'placeOfBirth' => $col[8],
                    ]);
                    $employeeService->create($data, $this->org, $school);
                    $employee = $employeeService->getRepository()->findOneBy(['name' => $col[3]]);
                }
            }

            $certificate = null;
            if(!is_null($col[14])){
                $certificateService = new CertificateService;
                $certificate        = $certificateService->getRepository()->findOneBy(['name' => $col[14]]);
                if ($certificate == null) {
                    $certificateService->create(collect(['name' => $col[14]]));
                    $certificate = $certificateService->getRepository()->findOneBy(['name' => $col[14]]);
                }
            }

            $employeeCertificate = new EmployeeCertificate;
            $employeeCertificate->setValidityPeriod($col[15]);

            if ($employee instanceof Employee) {
                $employeeCertificate->setEmployee($employee);
            }
            if ($certificate instanceof Certificate) {
                $employeeCertificate->setCertificate($certificate);
            }

            EntityManager::persist($employeeCertificate);
            EntityManager::flush();
        }
    }
}
