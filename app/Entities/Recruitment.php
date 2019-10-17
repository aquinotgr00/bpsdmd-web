<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recruitment
 *
 * @ORM\Table(name="penawaran_siswa")
 * @ORM\Entity
 */
class Recruitment
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
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="recruitments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $org;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="recruitments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="siswa_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $student;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="recruitments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jabatan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_input", type="date", nullable=true)
     */
    private $inputDate = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_update", type="date", nullable=true)
     */
    private $updateDate = NULL;

    /**
     * @var integer
     *
     * @ORM\Column(name="sudah_diemail", type="integer", nullable=true)
     */
    private $isEmail = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_email", type="date", nullable=true)
     */
    private $emailDate = NULL;

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
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

    /**
     * @return Organization
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param Organization $jobTitle
     */
    public function setJobTitle(Organization $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getInputDate()
    {
        return $this->inputDate;
    }

    /**
     * @param \DateTime $inputDate
     */
    public function setInputDate($inputDate): void
    {
        $this->inputDate = $inputDate;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $updateDate
     */
    public function setUpdateDate($updateDate): void
    {
        $this->updateDate = $updateDate;
    }

    /**
     * @return int
     */
    public function getIsEmail()
    {
        return $this->isEmail;
    }

    /**
     * @param int $isEmail
     */
    public function setIsEmail($isEmail): void
    {
        $this->isEmail = $isEmail;
    }

    /**
     * @return \DateTime
     */
    public function getEmailDate()
    {
        return $this->emailDate;
    }

    /**
     * @param \DateTime $emailDate
     */
    public function setEmailDate($emailDate): void
    {
        $this->emailDate = $emailDate;
    }
}