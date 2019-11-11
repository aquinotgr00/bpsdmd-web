<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table(name="instansi")
 * @ORM\Entity
 */
class Organization
{
    const TYPE_SUPPLY = 'supply';
    const TYPE_DEMAND = 'demand';
    const MODA_LAUT = 'laut';
    const MODA_UDARA = 'udara';
    const MODA_DARAT = 'darat';
    const MODA_KERETA = 'kereta api';
    const ACCREDITATION_A = 'A';
    const ACCREDITATION_B = 'B';
    const ACCREDITATION_C = 'C';
    const ACCREDITATION_NA = 'N/A';
    const UPLOAD_PATH = 'orgs/img';

    /**
     * @var string
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
     * @ORM\Column(name="nama_singkat", type="string", nullable=true)
     */
    private $shortName = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="sk_pendirian", type="string", nullable=true)
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
     * @ORM\Column(name="sk_operasional", type="string", nullable=true)
     */
    private $letterOfOpr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tgl_sk_operasional", type="date", nullable=true)
     */
    private $dateOfOpr = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="tipe", type="string", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="moda", type="string", nullable=true)
     */
    private $moda;

    /**
     * @var string
     *
     * @ORM\Column(name="alamat", type="string", nullable=true)
     */
    private $address = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", nullable=true)
     */
    private $photo = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="deskripsi", type="string", nullable=true)
     */
    private $description = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="telepon", type="string", nullable=true)
     */
    private $phoneNumber = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="faksimile", type="string", nullable=true)
     */
    private $fax = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", nullable=true)
     */
    private $website = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="status_milik", type="string", nullable=true)
     */
    private $ownershipStatus = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="pembina", type="string", nullable=true)
     */
    private $underSupervision = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="bentuk_pendidikan", type="string", nullable=true)
     */
    private $educationType = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="akreditasi", type="string", nullable=true)
     */
    private $accreditation = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="date", nullable=true)
     */
    private $lastUpdate = NULL;

    /**
     * @var ArrayCollection|User[]
     * @ORM\OneToMany(targetEntity="User", mappedBy="org")
     */
    private $users;

    /**
     * @var ArrayCollection|StudyProgram[]
     * @ORM\OneToMany(targetEntity="StudyProgram", mappedBy="org")
     */
    private $programs;

    /**
     * @var ArrayCollection|Teacher[]
     * @ORM\OneToMany(targetEntity="Teacher", mappedBy="org")
     */
    private $teachers;

    /**
     * @var ArrayCollection|Employee[]
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="org")
     */
    private $company;

    /**
     * @var ArrayCollection|Employee[]
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="school")
     */
    private $alumni;

    /**
     * @var ArrayCollection|Student[]
     * @ORM\OneToMany(targetEntity="Student", mappedBy="org")
     */
    private $students;

    /**
     * @var ArrayCollection|Recruitment[]
     * @ORM\OneToMany(targetEntity="Recruitment", mappedBy="org")
     */
    private $recruitment;

    /**
     * @var ArrayCollection|ShortCourse[]
     * @ORM\OneToMany(targetEntity="ShortCourse", mappedBy="org")
     */
    private $shortCourses;

    /**
     * @var ArrayCollection|JobFunction[]
     * @ORM\OneToMany(targetEntity="JobFunction", mappedBy="org")
     */
    private $jobFunctions;

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
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName): void
    {
        $this->shortName = $shortName;
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
    public function getLetterOfOpr(): ?string
    {
        return $this->letterOfOpr;
    }

    /**
     * @param string $letterOfOpr
     */
    public function setLetterOfOpr($letterOfOpr): void
    {
        $this->letterOfOpr = $letterOfOpr;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfOpr()
    {
        return $this->dateOfOpr;
    }

    /**
     * @param \DateTime $dateOfOpr
     */
    public function setDateOfOpr($dateOfOpr): void
    {
        $this->dateOfOpr = $dateOfOpr;
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getModa(): ?string
    {
        return $this->moda;
    }

    /**
     * @param string $moda
     */
    public function setModa($moda): void
    {
        $this->moda = $moda;
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
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax): void
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
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
    public function getOwnershipStatus(): ?string
    {
        return $this->ownershipStatus;
    }

    /**
     * @param string $ownershipStatus
     */
    public function setOwnershipStatus($ownershipStatus): void
    {
        $this->ownershipStatus = $ownershipStatus;
    }

    /**
     * @return string
     */
    public function getUnderSupervision(): ?string
    {
        return $this->underSupervision;
    }

    /**
     * @param string $underSupervision
     */
    public function setUnderSupervision($underSupervision): void
    {
        $this->underSupervision = $underSupervision;
    }

    /**
     * @return string
     */
    public function getEducationType(): ?string
    {
        return $this->educationType;
    }

    /**
     * @param string $educationType
     */
    public function setEducationType($educationType): void
    {
        $this->educationType = $educationType;
    }

    /**
     * @return string
     */
    public function getAccreditation(): ?string
    {
        return $this->accreditation;
    }

    /**
     * @param string $accreditation
     */
    public function setAccreditation($accreditation): void
    {
        $this->accreditation = $accreditation;
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
     * @return User[]|ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User[]|ArrayCollection $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    /**
     * @return StudyProgram[]|ArrayCollection
     */
    public function getPrograms()
    {
        return $this->programs;
    }

    /**
     * @param StudyProgram[]|ArrayCollection $programs
     */
    public function setPrograms($programs): void
    {
        $this->programs = $programs;
    }

    /**
     * @return Teacher[]|ArrayCollection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * @param Teacher[]|ArrayCollection $teachers
     */
    public function setTeachers($teachers): void
    {
        $this->teachers = $teachers;
    }

    /**
     * @return Employee[]|ArrayCollection
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Employee[]|ArrayCollection $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return Employee[]|ArrayCollection
     */
    public function getAlumni()
    {
        return $this->alumni;
    }

    /**
     * @param Employee[]|ArrayCollection $alumni
     */
    public function setAlumni($alumni): void
    {
        $this->alumni = $alumni;
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

    /**
     * @return ShortCourse[]|ArrayCollection
     */
    public function getShortCourses()
    {
        return $this->shortCourses;
    }

    /**
     * @param ShortCourse[]|ArrayCollection $shortCourses
     */
    public function setShortCourses($shortCourses): void
    {
        $this->shortCourses = $shortCourses;
    }

    /**
     * @return JobFunction[]|ArrayCollection
     */
    public function getJobFunctions()
    {
        return $this->jobFunctions;
    }

    /**
     * @param JobFunction[]|ArrayCollection $jobFunctions
     */
    public function setJobFunctions($jobFunctions): void
    {
        $this->jobFunctions = $jobFunctions;
    }
}
