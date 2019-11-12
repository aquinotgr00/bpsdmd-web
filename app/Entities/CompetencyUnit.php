<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompetencyUnit
 *
 * @ORM\Table(name="kompetensi_unit")
 * @ORM\Entity
 */
class CompetencyUnit
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
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="kompetensi", type="text", nullable=false)
     */
    private $competency;

    /**
     * @var ArrayCollection|Competency[]
     * @ORM\OneToMany(targetEntity="Competency", mappedBy="competencyUnit")
     */
    private $competencies;

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
     * @return string
     */
    public function getCode(): ?string
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
    public function getCompetency(): ?string
    {
        return $this->competency;
    }

    /**
     * @param string $competency
     */
    public function setCompetency(string $competency): void
    {
        $this->competency = $competency;
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
