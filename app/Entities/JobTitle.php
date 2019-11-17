<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * JobTitle
 *
 * @ORM\Table(name="jabatan")
 * @ORM\Entity
 */
class JobTitle
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
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="jobTitles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $org;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="pendidikan_minimal", type="string", nullable=true)
     */
    private $educationMinimal = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="ipk_minimal", type="string", nullable=true)
     */
    private $gpaMinimal = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="usia_minimal", type="string", nullable=true)
     */
    private $ageMinimal = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="pengalaman_minimal", type="string", nullable=true)
     */
    private $experienceMinimal = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=true)
     */
    private $code = NULL;

    /**
     * @var ArrayCollection|Recruitment[]
     * @ORM\OneToMany(targetEntity="Recruitment", mappedBy="jobTitle")
     */
    private $recruitment;

    /**
     * @var ArrayCollection|JobTitleFunction[]
     * @ORM\OneToMany(targetEntity="JobTitleFunction", mappedBy="jobTitle")
     */
    private $jobTitleFunction;

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
    public function getEducationMinimal(): ?string
    {
        return $this->educationMinimal;
    }

    /**
     * @param string $educationMinimal
     */
    public function setEducationMinimal($educationMinimal): void
    {
        $this->educationMinimal = $educationMinimal;
    }

    /**
     * @return string
     */
    public function getGpaMinimal(): ?string
    {
        return $this->gpaMinimal;
    }

    /**
     * @param string $gpaMinimal
     */
    public function setGpaMinimal($gpaMinimal): void
    {
        $this->gpaMinimal = $gpaMinimal;
    }

    /**
     * @return string
     */
    public function getExperienceMinimal(): ?string
    {
        return $this->experienceMinimal;
    }

    /**
     * @param string $experienceMinimal
     */
    public function setExperienceMinimal($experienceMinimal): void
    {
        $this->experienceMinimal = $experienceMinimal;
    }

    /**
     * @return string
     */
    public function getAgeMinimal(): ?string
    {
        return $this->ageMinimal;
    }

    /**
     * @param string $ageMinimal
     */
    public function setAgeMinimal($ageMinimal): void
    {
        $this->ageMinimal = $ageMinimal;
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
     * @return JobTitleFunction[]|ArrayCollection
     */
    public function getJobTitleFunction()
    {
        return $this->jobTitleFunction;
    }

    /**
     * @param JobTitleFunction[]|ArrayCollection $jobTitleFunction
     */
    public function setJobTitleFunction($jobTitleFunction): void
    {
        $this->jobTitleFunction = $jobTitleFunction;
    }
}
