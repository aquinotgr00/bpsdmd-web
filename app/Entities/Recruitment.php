<?php

namespace App\Entities;

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
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="recruitment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $org;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="recruitment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="siswa_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $student;

    /**
     * @var JobTitle
     *
     * @ORM\ManyToOne(targetEntity="JobTitle", inversedBy="recruitment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jabatan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobTitle = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_input", type="datetime", nullable=true)
     */
    private $inputDate = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_update", type="datetime", nullable=true)
     */
    private $updateDate = NULL;

    /**
     * @var bool
     *
     * @ORM\Column(name="sudah_diemail", type="boolean", nullable=true)
     */
    private $isEmail = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_email", type="datetime", nullable=true)
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
     * @return JobTitle
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param JobTitle $jobTitle
     */
    public function setJobTitle(JobTitle $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * @return string
     */
    public function getStatus()
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
     * @return bool
     */
    public function getIsEmail()
    {
        return $this->isEmail;
    }

    /**
     * @param bool $isEmail
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
