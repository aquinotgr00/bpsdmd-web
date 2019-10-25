<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompetencyMainFunction
 *
 * @ORM\Table(name="kompetensi_fungsi_utama")
 * @ORM\Entity
 */
class CompetencyMainFunction
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
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="fungsi_utama", type="string", nullable=false)
     */
    private $mainFunction;

    /**
     * @var ArrayCollection|Competency[]
     * @ORM\OneToMany(targetEntity="Competency", mappedBy="competencyMainFunction")
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
    public function getMainFunction(): string
    {
        return $this->mainFunction;
    }

    /**
     * @param string $mainFunction
     */
    public function setMainFunction(string $mainFunction): void
    {
        $this->mainFunction = $mainFunction;
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
