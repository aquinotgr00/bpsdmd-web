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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var ShortCourse
     *
     * @ORM\ManyToOne(targetEntity="ShortCourse", inversedBy="shortCourses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diklat_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $shortCourse;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pegawai_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $employee;

    /**
     * @var District
     *
     * @ORM\ManyToOne(targetEntity="District", inversedBy="districts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kabupaten_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="latar_belakang", type="string", nullable=false)
     */
    private $background;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lulus", type="boolean", nullable=false)
     */
    private $graduate;

    /**
     * @var string
     *
     * @ORM\Column(name="sertifikat_kompetensi", type="string", nullable=false)
     */
    private $competenceCertificat;

    /**
     * @var string
     *
     * @ORM\Column(name="sertifikat_pelatihan", type="string", nullable=true)
     */
    private $trainingCertificat;

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
     * @return District
     */
    public function getDistrict(): District
    {
        return $this->district;
    }

    /**
     * @param District $district
     */
    public function setDistrict(District $district): void
    {
        $this->district = $district;
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
    public function getCompetenceCertificat(): ?string
    {
        return $this->competenceCertificat;
    }

    /**
     * @param string $competenceCertificat
     */
    public function setCompetenceCertificat($competenceCertificat): void
    {
        $this->competenceCertificat = $competenceCertificat;
    }

    /**
     * @return string
     */
    public function getTrainingCertificat(): ?string
    {
        return $this->trainingCertificat;
    }

    /**
     * @param string $trainingCertificat
     */
    public function setTrainingCertificat($trainingCertificat): void
    {
        $this->trainingCertificat = $trainingCertificat;
    }
}