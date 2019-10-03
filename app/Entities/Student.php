<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="siswa")
 * @ORM\Entity
 */
class Student
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
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="students")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $org;

    /**
     * @var StudyProgram
     *
     * @ORM\ManyToOne(targetEntity="StudyProgram", inversedBy="students")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="program_studi_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $studyProgram = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=true)
     */
    private $code = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="periode_masuk", type="string", nullable=true)
     */
    private $period = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tahun_kurikulum", type="string", nullable=true)
     */
    private $curriculum = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_lahir", type="string", nullable=true)
     */
    private $dateOfBirth = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="kelas", type="string", nullable=true)
     */
    private $class = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="ipk", type="string", nullable=true)
     */
    private $ipk = NULL;

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
     * @return Organization
     */
    public function getOrg(): Organization
    {
        return $this->org;
    }

    /**
     * @param Organization $org
     */
    public function setOrg(Organization $org): void
    {
        $this->org = $org;
    }

    /**
     * @return StudyProgram
     */
    public function getStudyProgram(): StudyProgram
    {
        return $this->studyProgram;
    }

    /**
     * @param StudyProgram $studyProgram
     */
    public function setStudyProgram(StudyProgram $studyProgram): void
    {
        $this->studyProgram = $studyProgram;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
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
     * @return string
     */
    public function getPeriod(): ?string
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period): void
    {
        $this->period = $period;
    }

    /**
     * @return \DateTime
     */
    public function getCurriculum(): \DateTime
    {
        return $this->curriculum;
    }

    /**
     * @param \DateTime $curriculum
     */
    public function setCurriculum(\DateTime $curriculum): void
    {
        $this->curriculum = $curriculum;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth(\DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class): void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getIpk(): ?string
    {
        return $this->ipk;
    }

    /**
     * @param string $ipk
     */
    public function setIpk($ipk): void
    {
        $this->ipk = $ipk;
    }
}
