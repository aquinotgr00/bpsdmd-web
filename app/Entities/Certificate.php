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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
}
