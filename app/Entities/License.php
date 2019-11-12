<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * License
 *
 * @ORM\Table(name="lisensi")
 * @ORM\Entity
 */
class License
{
    const MODA_LAUT = 'laut';
    const MODA_UDARA = 'udara';
    const MODA_DARAT = 'darat';
    const MODA_KERETA = 'kereta api';

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
     * @ORM\Column(name="kode", type="string", nullable=false)
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
     * @ORM\Column(name="bab", type="string", nullable=false)
     */
    private $chapter;

    /**
     * @var string
     *
     * @ORM\Column(name="moda", type="string", nullable=false)
     */
    private $moda;

    /**
     * @var string
     *
     * @ORM\Column(name="kepala", type="string", nullable=true)
     */
    private $head;

    /**
     * @var ArrayCollection|LicenseStudyProgram[]
     * @ORM\OneToMany(targetEntity="LicenseStudyProgram", mappedBy="license")
     */
    private $licenseStudyProgram;

    /**
     * @var ArrayCollection|LicenseCompetency[]
     * @ORM\OneToMany(targetEntity="LicenseCompetency", mappedBy="license")
     */
    private $licenseCompetency;

    /**
     * @var ArrayCollection|JobTitleFunctionLicense[]
     * @ORM\OneToMany(targetEntity="JobTitleFunctionLicense", mappedBy="license")
     */
    private $jobTitleFunctionLicense;

    /**
     * @var ArrayCollection|ShortCourseLicense[]
     * @ORM\OneToMany(targetEntity="ShortCourseLicense", mappedBy="license")
     */
    private $shortCourseLicense;

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
    public function getChapter(): ?string
    {
        return $this->chapter;
    }

    /**
     * @param string $chapter
     */
    public function setChapter($chapter): void
    {
        $this->chapter = $chapter;
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
    public function getHead(): ?string
    {
        return $this->head;
    }

    /**
     * @param string $head
     */
    public function setHead($head): void
    {
        $this->head = $head;
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
     * @return LicenseCompetency[]|ArrayCollection
     */
    public function getLicenseCompetency()
    {
        return $this->licenseCompetency;
    }

    /**
     * @param LicenseCompetency[]|ArrayCollection $licenseCompetency
     */
    public function setLicenseCompetency($licenseCompetency): void
    {
        $this->licenseCompetency = $licenseCompetency;
    }

    /**
     * @return JobTitleFunctionLicense[]|ArrayCollection
     */
    public function getJobTitleFunctionLicense()
    {
        return $this->jobTitleFunctionLicense;
    }

    /**
     * @param JobTitleFunctionLicense[]|ArrayCollection $jobTitleFunctionLicense
     */
    public function setJobTitleFunctionLicense($jobTitleFunctionLicense): void
    {
        $this->jobTitleFunctionLicense = $jobTitleFunctionLicense;
    }

    /**
     * @return ShortCourseLicense[]|ArrayCollection
     */
    public function getShortCourseLicense()
    {
        return $this->shortCourseLicense;
    }

    /**
     * @param ShortCourseLicense[]|ArrayCollection $shortCourseLicense
     */
    public function setShortCourseLicense($shortCourseLicense): void
    {
        $this->shortCourseLicense = $shortCourseLicense;
    }
}
