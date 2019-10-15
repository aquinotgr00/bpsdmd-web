<?php

namespace App\Imports;

use EntityManager;
use App\Entities\EmployeeCertificate;
use App\Entities\Organization;
use App\Entities\Employee;
use App\Entities\Certificate;
use App\Services\Application\AuthService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeCertificateImport implements ToCollection
{
    /** @var Employee $employee */
    private $employee;

    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
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

            $employeeCertificate = new EmployeeCertificate;
            $employeeCertificate->setValidityPeriod($row[14]);

            EntityManager::persist($employeeCertificate);
            EntityManager::flush();
        }
    }
}
