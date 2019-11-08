<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * LicenseCompetency
 *
 * @ORM\Table(name="lisensi_kompetensi")
 * @ORM\Entity
 */

class LicenseCompetency
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
     * @var Competency
     *
     * @ORM\ManyToOne(targetEntity="Competency", inversedBy="licenseCompetency", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competency;

    /**
     * @var License
     *
     * @ORM\ManyToOne(targetEntity="License", inversedBy="licenseCompetency", cascade={"persist"})
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
}
