<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * JobTitle
 *
 * @ORM\Table(name="jabatan_fungsi_pekerjaan")
 * @ORM\Entity
 */
class JobTitleFunction
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var JobTitle
     *
     * @ORM\ManyToOne(targetEntity="JobTitle", inversedBy="jobTitleFunction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jabatan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobTitle;

    /**
     * @var JobFunction
     *
     * @ORM\ManyToOne(targetEntity="JobFunction", inversedBy="jobTitleFunction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fungsi_pekerjaan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobFunction;

    /**
     * @var ArrayCollection|JobTitleFunctionLicense[]
     * @ORM\OneToMany(targetEntity="JobTitleFunctionLicense", mappedBy="jobTitleFunction")
     */
    private $jobTitleFunctionLicense;

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
     * @return JobTitle
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param JobTitle $jobTitle
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
}
