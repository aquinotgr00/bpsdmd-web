<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="siswa")
 * @ORM\Entity
 */
class Student
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const UPLOAD_PATH = 'students/img';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="udid", type="string", nullable=true)
     */
    private $idDikti;

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
     * @ORM\Column(name="nim", type="string", nullable=false)
     */
    private $nim;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="jenis_kelamin", type="string", nullable=true)
     */
    private $gender = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="tempat_lahir", type="string", nullable=true)
     */
    private $placeOfBirth = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_lahir", type="date", nullable=true)
     */
    private $dateOfBirth = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="alamat", type="string", nullable=true)
     */
    private $address = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="telepon", type="string", nullable=true)
     */
    private $phoneNumber = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="handphone", type="string", nullable=true)
     */
    private $mobilePhoneNumber = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="agama", type="string", nullable=true)
     */
    private $religion = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="ibu_kandung", type="string", nullable=true)
     */
    private $motherName = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="kewarganegaraan", type="string", nullable=true)
     */
    private $nationality = NULL;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wna", type="boolean", nullable=false)
     */
    private $foreignCitizen;

    /**
     * @var boolean
     *
     * @ORM\Column(name="penerima_kps", type="boolean", nullable=false)
     */
    private $socialProtectionCard;

    /**
     * @var string
     *
     * @ORM\Column(name="jenis_tinggal", type="string", nullable=true)
     */
    private $occupationType = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="no_ktp", type="string", nullable=true)
     */
    private $identityNumber = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tgl_masuk", type="date", nullable=true)
     */
    private $enrollmentDateStart = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tgl_keluar", type="date", nullable=true)
     */
    private $enrollmentDateEnd = NULL;

    /**
     * @var integer
     *
     * @ORM\Column(name="smt_mulai", type="bigint", nullable=false)
     */
    private $startSemester;

    /**
     * @var integer
     *
     * @ORM\Column(name="smt_tempuh", type="bigint", nullable=false)
     */
    private $currentSemester;

    /**
     * @var integer
     *
     * @ORM\Column(name="sks", type="bigint", nullable=false)
     */
    private $studentCredits;

    /**
     * @var string
     *
     * @ORM\Column(name="ipk", type="string", nullable=true)
     */
    private $ipk = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="no_ijazah", type="string", nullable=true)
     */
    private $certificateNumber = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tgl_sk_yudisium", type="date", nullable=true)
     */
    private $graduationJudgementDate = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="jenis_daftar", type="string", nullable=true)
     */
    private $enrollmentType = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="jenis_keluar", type="string", nullable=true)
     */
    private $graduationType = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="date", nullable=true)
     */
    private $lastUpdate = NULL;

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
     * @var string
     *
     * @ORM\Column(name="kelas", type="string", nullable=true)
     */
    private $class = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="tahun_lulus", type="string", nullable=true)
     */
    private $graduationYear = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", nullable=true)
     */
    private $photo = NULL;

    /**
     * @var ArrayCollection|Recruitment[]
     * @ORM\OneToMany(targetEntity="Recruitment", mappedBy="student")
     */
    private $recruitment;

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
    public function getStudyProgram()
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
    public function getNim(): ?string
    {
        return $this->nim;
    }

    /**
     * @param string $nim
     */
    public function setNim($nim): void
    {
        $this->nim = $nim;
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
    public function getCurriculum()
    {
        return $this->curriculum;
    }

    /**
     * @param \DateTime $curriculum
     */
    public function setCurriculum($curriculum): void
    {
        $this->curriculum = $curriculum;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    /**
     * @param string $placeOfBirth
     */
    public function setPlaceOfBirth($placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getMobilePhoneNumber(): ?string
    {
        return $this->mobilePhoneNumber;
    }

    /**
     * @param string $mobilePhoneNumber
     */
    public function setMobilePhoneNumber($mobilePhoneNumber): void
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getReligion(): ?string
    {
        return $this->religion;
    }

    /**
     * @param string $religion
     */
    public function setReligion($religion): void
    {
        $this->religion = $religion;
    }

    /**
     * @return string
     */
    public function getMotherName(): ?string
    {
        return $this->motherName;
    }

    /**
     * @param string $motherName
     */
    public function setMotherName($motherName): void
    {
        $this->motherName = $motherName;
    }

    /**
     * @return string
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     */
    public function setNationality($nationality): void
    {
        $this->nationality = $nationality;
    }

    /**
     * @return boolean
     */
    public function getForeignCitizen(): ?bool
    {
        return $this->foreignCitizen;
    }

    /**
     * @param boolean $foreignCitizen
     */
    public function setForeignCitizen($foreignCitizen): void
    {
        $this->foreignCitizen = $foreignCitizen;
    }

    /**
     * @return boolean
     */
    public function getSocialProtectionCard(): ?bool
    {
        return $this->socialProtectionCard;
    }

    /**
     * @param boolean $socialProtectionCard
     */
    public function setSocialProtectionCard($socialProtectionCard): void
    {
        $this->socialProtectionCard = $socialProtectionCard;
    }

    /**
     * @return string
     */
    public function getOccupationType(): ?string
    {
        return $this->occupationType;
    }

    /**
     * @param string $occupationType
     */
    public function setOccupationType($occupationType): void
    {
        $this->occupationType = $occupationType;
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

    /**
     * @return string
     */
    public function getCertificateNumber(): ?string
    {
        return $this->certificateNumber;
    }

    /**
     * @param string $certificateNumber
     */
    public function setCertificateNumber($certificateNumber): void
    {
        $this->certificateNumber = $certificateNumber;
    }

    /**
     * @return \DateTime
     */
    public function getGraduationJudgementDate()
    {
        return $this->graduationJudgementDate;
    }

    /**
     * @param \DateTime $graduationJudgementDate
     */
    public function setGraduationJudgementDate($graduationJudgementDate): void
    {
        $this->graduationJudgementDate = $graduationJudgementDate;
    }

    /**
     * @return string
     */
    public function getEnrollmentType(): ?string
    {
        return $this->enrollmentType;
    }

    /**
     * @param string $enrollmentType
     */
    public function setEnrollmentType($enrollmentType): void
    {
        $this->enrollmentType = $enrollmentType;
    }

    /**
     * @return string
     */
    public function getGraduationType(): ?string
    {
        return $this->graduationType;
    }

    /**
     * @param string $graduationType
     */
    public function setGraduationType($graduationType): void
    {
        $this->graduationType = $graduationType;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    /**
     * @return \DateTime $lastUpdate
     */
    public function setLastUpdate($lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @return string
     */
    public function getIdentityNumber(): ?string
    {
        return $this->identityNumber;
    }

    /**
     * @param string $identityNumber
     */
    public function setIdentityNumber($identityNumber): void
    {
        $this->identityNumber = $identityNumber;
    }

    /**
     * @return \DateTime
     */
    public function getEnrollmentDateStart()
    {
        return $this->enrollmentDateStart;
    }

    /**
     * @param \DateTime $enrollmentDateStart
     */
    public function setEnrollmentDateStart($enrollmentDateStart): void
    {
        $this->enrollmentDateStart = $enrollmentDateStart;
    }

    /**
     * @return \DateTime
     */
    public function getEnrollmentDateEnd()
    {
        return $this->enrollmentDateEnd;
    }

    /**
     * @param \DateTime $enrollmentDateEnd
     */
    public function setEnrollmentDateEnd($enrollmentDateEnd): void
    {
        $this->enrollmentDateEnd = $enrollmentDateEnd;
    }

    /**
     * @return int
     */
    public function getStartSemester(): int
    {
        return $this->startSemester;
    }

    /**
     * @param int $startSemester
     */
    public function setStartSemester(int $startSemester): void
    {
        $this->startSemester = $startSemester;
    }

    /**
     * @return int
     */
    public function getCurrentSemester(): int
    {
        return $this->currentSemester;
    }

    /**
     * @param int $currentSemester
     */
    public function setCurrentSemester(int $currentSemester): void
    {
        $this->currentSemester = $currentSemester;
    }

    /**
     * @return int
     */
    public function getStudentCredits(): int
    {
        return $this->studentCredits;
    }

    /**
     * @param int $studentCredits
     */
    public function setStudentCredits(int $studentCredits): void
    {
        $this->studentCredits = $studentCredits;
    }

    /**
     * @return string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
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
    public function getGraduationYear(): ?string
    {
        return $this->graduationYear;
    }

    /**
     * @param string $graduationYear
     */
    public function setGraduationYear($graduationYear): void
    {
        $this->graduationYear = $graduationYear;
    }

    /**
     * @return string
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return Recruitment[]|ArrayCollection
     */
    public function getRecruitment()
    {
        return $this->recruitment;
    }

    /**
     * @param Recruitment[]|ArrayCollection $recruitment
     */
    public function setRecruitment($recruitment): void
    {
        $this->recruitment = $recruitment;
    }
}
