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
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeCertificateImport implements ToCollection
{
    /** @var Employee $employee */
    private $employee;

    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
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

            $employeeCertificate = new EmployeeCertificate;
            if ($col[14]) {
                $employeeCertificate->setValidityPeriod(date_format(Date::excelToDateTimeObject($col[14]), 'd-m-Y'));
            }

            EntityManager::persist($employeeCertificate);
            EntityManager::flush();
        }
    }
}
