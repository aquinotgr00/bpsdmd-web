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
     * @ORM\Column(name="singkatan", type="string", nullable=true)
     */
    private $shortName = NULL;

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
     * @ORM\Column(name="akreditasi", type="string", nullable=true)
     */
    private $accreditation = NULL;

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
