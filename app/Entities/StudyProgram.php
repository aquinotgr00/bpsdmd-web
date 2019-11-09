<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * StudyProgram
 *
 * @ORM\Table(name="program_studi")
 * @ORM\Entity
 */
class StudyProgram
{
    const DEGREE_D1 = 'd1';
    const DEGREE_D2 = 'd2';
    const DEGREE_D3 = 'd3';
    const DEGREE_S1 = 's1';
    const DEGREE_S2 = 's2';

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="programs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $org = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="udid", type="string", nullable=true)
     */
    private $idDikti = NULL;

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
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="visi", type="string", nullable=true)
     */
    private $vision;

    /**
     * @var string
     *
     * @ORM\Column(name="misi", type="string", nullable=true)
     */
    private $mission;

    /**
     * @var string
     *
     * @ORM\Column(name="kompetensi", type="string", nullable=true)
     */
    private $competency;

    /**
     * @var string
     *
     * @ORM\Column(name="jenjang", type="string", nullable=true)
     */
    private $degree = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tgl_berdiri", type="date", nullable=true)
     */
    private $estDate = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="sk_selenggara", type="string", nullable=true)
     */
    private $letterOfEst = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tgl_sk_pendirian", type="date", nullable=true)
     */
    private $dateOfEst = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="sks_lulus", type="bigint", nullable=false)
     */
    private $passingGradeCredits;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="date", nullable=true)
     */
    private $lastUpdate = NULL;

    /**
     * @var ArrayCollection|Student[]
     * @ORM\OneToMany(targetEntity="Student", mappedBy="studyProgram")
     */
    private $students;

    /**
     * @var ArrayCollection|LicenseStudyProgram[]
     * @ORM\OneToMany(targetEntity="LicenseStudyProgram", mappedBy="studyProgram")
     */
    private $licenseStudyProgram;

    /**
     * @var ArrayCollection|StudyProgramCompetency[]
     * @ORM\OneToMany(targetEntity="StudyProgramCompetency", mappedBy="studyProgram")
     */
    private $studyProgramCompetency;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return Organization
     */
    public function getOrg()
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
     * @return string
     */
    public function getIdDikti(): ?string
    {
        return $this->idDikti;
    }

    /**
     * @param string $idDikti
     */
    public function setIdDikti($idDikti): void
    {
        $this->idDikti = $idDikti;
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

    /**
     * @return string
     */
    public function getVision(): ?string
    {
        return $this->vision;
    }

    /**
     * @param string $vision
     */
    public function setVision($vision): void
    {
        $this->vision = $vision;
    }

    /**
     * @return string
     */
    public function getMission(): ?string
    {
        return $this->mission;
    }

    /**
     * @param string $mission
     */
    public function setMission($mission): void
    {
        $this->mission = $mission;
    }

    /**
     * @return string
     */
    public function getCompetency(): ?string
    {
        return $this->competency;
    }

    /**
     * @param string $competency
     */
    public function setCompetency($competency): void
    {
        $this->competency = $competency;
    }

    /**
     * @return string
     */
    public function getDegree(): ?string
    {
        return $this->degree;
    }

    /**
     * @param string $degree
     */
    public function setDegree($degree): void
    {
        $this->degree = $degree;
    }

    /**
     * @return \DateTime
     */
    public function getEstDate()
    {
        return $this->estDate;
    }

    /**
     * @param \DateTime $estDate
     */
    public function setEstDate($estDate): void
    {
        $this->estDate = $estDate;
    }

    /**
     * @return string
     */
    public function getLetterOfEst(): ?string
    {
        return $this->letterOfEst;
    }

    /**
     * @param string $letterOfEst
     */
    public function setLetterOfEst($letterOfEst): void
    {
        $this->letterOfEst = $letterOfEst;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfEst()
    {
        return $this->dateOfEst;
    }

    /**
     * @param \DateTime $dateOfEst
     */
    public function setDateOfEst($dateOfEst): void
    {
        $this->dateOfEst = $dateOfEst;
    }

    /**
     * @return string
     */
    public function getPassingGradeCredits(): ?string
    {
        return $this->passingGradeCredits;
    }

    /**
     * @param string $passingGradeCredits
     */
    public function setPassingGradeCredits($passingGradeCredits): void
    {
        $this->passingGradeCredits = $passingGradeCredits;
    }

    /**
     * @return string
     */
    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    /**
     * @param string $lastUpdate
     */
    public function setLastUpdate($lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @return Student[]|ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param Student[]|ArrayCollection $students
     */
    public function setStudents($students): void
    {
        $this->students = $students;
    }

    /**
     * @return LicenseStudyProgram[]|ArrayCollection
     */
    public function getLicenseStudyProgram()
    {
        return $this->licenseStudyProgram;
    }

    /**
     * @param LicenseStudyProgram[]|ArrayCollection $licenseStudyProgram
     */
    public function setLicenseStudyProgram($licenseStudyProgram): void
    {
        $this->licenseStudyProgram = $licenseStudyProgram;
    }

    /**
     * @return StudyProgramCompetency[]|ArrayCollection
     */
    public function getStudyProgramCompetency()
    {
        return $this->studyProgramCompetency;
    }

    /**
     * @param StudyProgramCompetency[]|ArrayCollection $studyProgramCompetency
     */
    public function setStudyProgramCompetency($studyProgramCompetency): void
    {
        $this->studyProgramCompetency = $studyProgramCompetency;
    }

    /**
     * @return array|string
     */
    public function getLicenseStudyProgramIds()
    {
        $licenses = $this->licenseStudyProgram;
        $result = [];

        foreach ($licenses as $license) {
            $result[] = $license->getId();
        }

        return $result;
    }
}
