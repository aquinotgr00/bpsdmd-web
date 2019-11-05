<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeCertificate
 *
 * @ORM\Table(name="sertifikat_pegawai")
 * @ORM\Entity
 */
class EmployeeCertificate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="employeeCertificates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pegawai_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $employee;

    /**
     * @var Certificate
     *
     * @ORM\ManyToOne(targetEntity="Certificate", inversedBy="employeeCertificates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sertifikat_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $certificate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="masa_berlaku", type="date", nullable=true)
     */
    private $validityPeriod = NULL;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Employee
     */
    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee(Employee $employee): void
    {
        $this->employee = $employee;
    }

    /**
     * @return Certificate
     */
    public function getCertificate(): Certificate
    {
        return $this->certificate;
    }

    /**
     * @param Certificate $certificate
     */
    public function setCertificate(Certificate $certificate): void
    {
        $this->certificate = $certificate;
    }

    /**
     * @return \DateTime
     */
    public function getValidityPeriod()
    {
        return $this->validityPeriod;
    }

    /**
     * @param \DateTime $validityPeriod
     */
    public function setValidityPeriod($validityPeriod): void
    {
        $this->validityPeriod = $validityPeriod;
    }
}
