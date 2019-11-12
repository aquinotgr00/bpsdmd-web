<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="pegawai")
 * @ORM\Entity
 */
class Employee
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const UPLOAD_PATH = 'employees/img';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $org;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="no_ktp", type="string", nullable=true)
     */
    private $identityNumber;

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
     * @ORM\Column(name="bahasa", type="string", nullable=true)
     */
    private $language = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="kewarganegaraan", type="string", nullable=true)
     */
    private $nationality = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="gelar", type="string", nullable=true)
     */
    private $degree = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="level_pendidikan", type="string", nullable=true)
     */
    private $educationLevel = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="lokasi", type="string", nullable=false)
     */
    private $location = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="durasi", type="string", nullable=false)
     */
    private $duration = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="major", type="string", nullable=true)
     */
    private $major = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", nullable=true)
     */
    private $photo = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="no_hp", type="string", nullable=true)
     */
    private $phoneNumber = NULL;

    /**
     * @var ArrayCollection|EmployeeCertificate[]
     * @ORM\OneToMany(targetEntity="EmployeeCertificate", mappedBy="employee")
     */
    private $employeeCertificates;

    /**
     * @var ArrayCollection|ShortCourseParticipant[]
     * @ORM\OneToMany(targetEntity="ShortCourseParticipant", mappedBy="employee")
     */
    private $shortCourseParticipants;

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
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
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
     * @return string
     */
    public function getEducationLevel(): ?string
    {
        return $this->educationLevel;
    }

    /**
     * @param string $educationLevel
     */
    public function setEducationLevel($educationLevel): void
    {
        $this->educationLevel = $educationLevel;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getMajor(): ?string
    {
        return $this->major;
    }

    /**
     * @param string $major
     */
    public function setMajor($major): void
    {
        $this->major = $major;
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
     * @return ShortCourseParticipant[]|ArrayCollection
     */
    public function getShortCourseParticipants()
    {
        return $this->shortCourseParticipants;
    }

    /**
     * @param ShortCourseParticipant[]|ArrayCollection $shortCourseParticipants
     */
    public function setShortCourseParticipants($shortCourseParticipants): void
    {
        $this->shortCourseParticipants = $shortCourseParticipants;
    }
}
