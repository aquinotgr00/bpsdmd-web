<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Certificate
 *
 * @ORM\Table(name="sertifikat")
 * @ORM\Entity
 */
class Certificate
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
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="certificate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pegawai_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $employee;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var ArrayCollection|EmployeeCertificate[]
     * @ORM\OneToMany(targetEntity="EmployeeCertificate", mappedBy="certificate")
     */
    private $employeeCertificates;

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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return EmployeeCertificate[]|ArrayCollection
     */
    public function getEmployeeCertificates()
    {
        return $this->employeeCertificates;
    }

    /**
     * @param EmployeeCertificate[]|ArrayCollection $employeeCertificates
     */
    public function setEmployeeCertificates($employeeCertificates): void
    {
        $this->employeeCertificates = $employeeCertificates;
    }

    /**
     * @return string
     */
    public function getValidityPeriod(): ?string
    {
        return $this->validityPeriod;
    }

    /**
     * @param string $validityPeriod
     */
    public function setValidityPeriod($validityPeriod): void
    {
        $this->validityPeriod = $validityPeriod;
    }
}
