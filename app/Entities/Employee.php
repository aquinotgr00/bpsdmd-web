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
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="alumni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sekolah_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $school;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="company")
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
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="no_ktp", type="string", nullable=false)
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
    public function getSchool(): Organization
    {
        return $this->school;
    }

    /**
     * @param Organization $school
     */
    public function setSchool(Organization $school): void
    {
        $this->school = $school;
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
