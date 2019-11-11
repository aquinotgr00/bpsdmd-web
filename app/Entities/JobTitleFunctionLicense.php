<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * JobTitle
 *
 * @ORM\Table(name="jabatan_fungsi_pekerjaan_lisensi")
 * @ORM\Entity
 */
class JobTitleFunctionLicense
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
     * @var JobTitleFunction
     *
     * @ORM\ManyToOne(targetEntity="JobTitleFunction", inversedBy="jobTitleFunctionLicense")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jabatan_fungsi_pekerjaan_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $jobTitleFunction;

    /**
     * @var License
     *
     * @ORM\ManyToOne(targetEntity="License", inversedBy="jobTitleFunctionLicense")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lisensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $license;

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
     * @return JobTitleFunction
     */
    public function getJobTitleFunction()
    {
        return $this->jobTitleFunction;
    }

    /**
     * @param JobTitleFunction $jobTitleFunction
     */
    public function setJobTitleFunction(JobTitleFunction $jobTitleFunction): void
    {
        $this->jobTitleFunction = $jobTitleFunction;
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
}
