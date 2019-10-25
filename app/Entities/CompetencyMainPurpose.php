<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompetencyMainPurpose
 *
 * @ORM\Table(name="kompetensi_tujuan_utama")
 * @ORM\Entity
 */
class CompetencyMainPurpose
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="tujuan_utama", type="string", nullable=false)
     */
    private $mainPurpose;

    /**
     * @var ArrayCollection|Competency[]
     * @ORM\OneToMany(targetEntity="Competency", mappedBy="competencyMainPurpose")
     */
    private $competencies;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
    public function getMainPurpose(): string
    {
        return $this->mainPurpose;
    }

    /**
     * @param string $mainPurpose
     */
    public function setMainPurpose(string $mainPurpose): void
    {
        $this->mainPurpose = $mainPurpose;
    }

    /**
     * @return Competency[]|ArrayCollection
     */
    public function getCompetencies()
    {
        return $this->competencies;
    }

    /**
     * @param Competency[]|ArrayCollection $competencies
     */
    public function setCompetencies($competencies): void
    {
        $this->competencies = $competencies;
    }
}
