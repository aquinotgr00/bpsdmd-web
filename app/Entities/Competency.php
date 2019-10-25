<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Competency
 *
 * @ORM\Table(name="kompetensi")
 * @ORM\Entity
 */
class Competency
{
    const MODA_LAUT = 'laut';
    const MODA_UDARA = 'udara';
    const MODA_DARAT = 'darat';
    const MODA_KERETA = 'kereta api';
    const TYPE_PM7 = 'PM7';

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="id", type="bigint", nullable=false)
=======
     * @ORM\Column(name="id", type="string", nullable=false)
>>>>>>> added competency
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var CompetencyMainPurpose
     *
     * @ORM\ManyToOne(targetEntity="CompetencyMainPurpose", inversedBy="competencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_tujuan_utama_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competencyMainPurpose;

    /**
     * @var CompetencyKeyFunction
     *
     * @ORM\ManyToOne(targetEntity="CompetencyKeyFunction", inversedBy="competencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_fungsi_kunci_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competencyKeyFunction;

    /**
     * @var CompetencyMainFunction
     *
     * @ORM\ManyToOne(targetEntity="CompetencyMainFunction", inversedBy="competencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_fungsi_utama_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competencyMainFunction;

    /**
     * @var CompetencyUnit
     *
     * @ORM\ManyToOne(targetEntity="CompetencyUnit", inversedBy="competencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_unit_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competencyUnit;

    /**
     * @var string
     *
     * @ORM\Column(name="moda", type="string", nullable=false)
     */
    private $moda;

    /**
     * @var string
     *
     * @ORM\Column(name="tipe", type="string", nullable=false)
     */
    private $type;

    /**
     * @var ArrayCollection|ShortCourseCompetency[]
     * @ORM\OneToMany(targetEntity="ShortCourseCompetency", mappedBy="competency")
     */
    private $shortCourseCompetency;

    /**
     * @var ArrayCollection|StudyProgramCompetency[]
     * @ORM\OneToMany(targetEntity="StudyProgramCompetency", mappedBy="competency")
     */
    private $studyProgramCompetency;

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
     * @return CompetencyMainPurpose
     */
    public function getCompetencyMainPurpose(): CompetencyMainPurpose
    {
        return $this->competencyMainPurpose;
    }

    /**
     * @param CompetencyMainPurpose $competencyMainPurpose
     */
    public function setCompetencyMainPurpose(CompetencyMainPurpose $competencyMainPurpose): void
    {
        $this->competencyMainPurpose = $competencyMainPurpose;
    }

    /**
     * @return CompetencyKeyFunction
     */
    public function getCompetencyKeyFunction(): CompetencyKeyFunction
    {
        return $this->competencyKeyFunction;
    }

    /**
     * @param CompetencyKeyFunction $competencyKeyFunction
     */
    public function setCompetencyKeyFunction(CompetencyKeyFunction $competencyKeyFunction): void
    {
        $this->competencyKeyFunction = $competencyKeyFunction;
    }

    /**
     * @return CompetencyMainFunction
     */
    public function getCompetencyMainFunction(): CompetencyMainFunction
    {
        return $this->competencyMainFunction;
    }

    /**
     * @param CompetencyMainFunction $competencyMainFunction
     */
    public function setCompetencyMainFunction(CompetencyMainFunction $competencyMainFunction): void
    {
        $this->competencyMainFunction = $competencyMainFunction;
    }

    /**
     * @return CompetencyUnit
     */
    public function getCompetencyUnit(): CompetencyUnit
    {
        return $this->competencyUnit;
    }

    /**
     * @param CompetencyUnit $competencyUnit
     */
    public function setCompetencyUnit(CompetencyUnit $competencyUnit): void
    {
        $this->competencyUnit = $competencyUnit;
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return StudyProgramCompetency[]|ArrayCollection
     */
    public function getStudyProgramCompetency()
    {
        return $this->studyProgramCompetency;
    }

    /**
     * @param StudyProgramCompetency[]|ArrayCollection $studyProgramCompetency
     */
    public function setStudyProgramCompetency($studyProgramCompetency): void
    {
        $this->studyProgramCompetency = $studyProgramCompetency;
    }
}
