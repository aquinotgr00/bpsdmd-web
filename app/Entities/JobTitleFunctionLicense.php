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
     * @var string
     *
     * @ORM\Column(name="lisensi", type="string", nullable=false)
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
    public function setJobTitleFunction(Organization $jobTitleFunction): void
    {
        $this->jobTitleFunction = $jobTitleFunction;
    }

    /**
     * @return string
     */
    public function getLicense(): ?string
    {
        return $this->license;
    }

    /**
     * @param string $license
     */
    public function setLicense($license): void
    {
        $this->license = $license;
    }
}
