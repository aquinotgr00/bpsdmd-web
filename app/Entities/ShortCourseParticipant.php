<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShortCourseParticipant
 *
 * @ORM\Table(name="peserta_diklat")
 * @ORM\Entity
 */
class ShortCourseParticipant
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
     * @var ShortCourse
     *
     * @ORM\ManyToOne(targetEntity="ShortCourse", inversedBy="shortCourseParticipants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diklat_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $shortCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="latar_belakang", type="string", nullable=true)
     */
    private $background;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lulus", type="boolean", nullable=true)
     */
    private $graduate;

    /**
     * @var string
     *
     * @ORM\Column(name="sertifikat_kompetensi", type="string", nullable=false)
     */
    private $competenceCertificate;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="shortCourseParticipants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pegawai_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $employee;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

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
     * @return ShortCourse
     */
    public function getShortCourse(): ShortCourse
    {
        return $this->shortCourse;
    }

    /**
     * @param ShortCourse $shortCourse
     */
    public function setShortCourse(ShortCourse $shortCourse): void
    {
        $this->shortCourse = $shortCourse;
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
    public function getBackground(): ?string
    {
        return $this->background;
    }

    /**
     * @param string $background
     */
    public function setBackground($background): void
    {
        $this->background = $background;
    }

    /**
     * @return boolean
     */
    public function getGraduate(): ?bool
    {
        return $this->graduate;
    }

    /**
     * @param boolean $graduate
     */
    public function setGraduate($graduate): void
    {
        $this->graduate = $graduate;
    }

    /**
     * @return string
     */
    public function getCompetenceCertificate(): ?string
    {
        return $this->competenceCertificate;
    }

    /**
     * @param string $competenceCertificate
     */
    public function setCompetenceCertificate($competenceCertificate): void
    {
        $this->competenceCertificate = $competenceCertificate;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
