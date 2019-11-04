<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobLicenseCompetency
 *
 * @ORM\Table(name="kompetensi_lisensi_pekerjaan")
 * @ORM\Entity
 */

class JobLicenseCompetency
{
    /**
    * @var int
    *
    * @ORM\Column(name="id", type="bigint", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    private $id;

    /**
     * @var JobTitle
     *
     * @ORM\ManyToOne(targetEntity="JobTitle", inversedBy="jobLicenseCompetency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jabatan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobTitle;

    /**
     * @var JobFunction
     *
     * @ORM\ManyToOne(targetEntity="JobFunction", inversedBy="jobLicenseCompetency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fungsi_pekerjaan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobFunction;

    /**
     * @var Competency
     *
     * @ORM\ManyToOne(targetEntity="Competency", inversedBy="jobLicenseCompetency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competency;

    /**
     * @var License
     *
     * @ORM\ManyToOne(targetEntity="License", inversedBy="jobLicenseCompetency", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lisensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $license;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="kepala", type="string", nullable=false)
     */
    private $head;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="pendidikan_minimal", type="string", nullable=false)
     */
    private $minimumEducation;

    /**
     * @var string
     *
     * @ORM\Column(name="ipk_minimal", type="string", nullable=false)
     */
    private $minimumGpa;

    /**
     * @var string
     *
     * @ORM\Column(name="keterangan", type="string", nullable=false)
     */
    private $description;

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
     * @return JobFunction
     */
    public function getJobFunction()
    {
        return $this->jobFunction;
    }

    /**
     * @param JobFunction $jobFunction
     */
    public function setJobFunction(JobFunction $jobFunction): void
    {
        $this->jobFunction = $jobFunction;
    }

    /**
     * @return Competency
     */
    public function getCompetency(): Competency
    {
        return $this->competency;
    }

    /**
     * @param Competency $competency
     */
    public function setCompetency(Competency $competency): void
    {
        $this->competency = $competency;
    }

    /**
     * @return License
     */
    public function getLicense(): License
    {
        return $this->license;
    }

    /**
     * @param License $license
     */
    public function setLicense(License $license): void
    {
        $this->license = $license;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @param string $head
     */
    public function setHead(string $head): void
    {
        $this->head = $head;
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
    public function getMinimumEducation(): ?string
    {
        return $this->minimumEducation;
    }

    /**
     * @param string $minimumEducation
     */
    public function setMinimumEducation($minimumEducation): void
    {
        $this->minimumEducation = $minimumEducation;
    }

    /**
     * @return string
     */
    public function getMinimumGpa(): ?string
    {
        return $this->minimumGpa;
    }

    /**
     * @param string $minimumGpa
     */
    public function setMinimumGpa($minimumGpa): void
    {
        $this->minimumGpa = $minimumGpa;
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
}
