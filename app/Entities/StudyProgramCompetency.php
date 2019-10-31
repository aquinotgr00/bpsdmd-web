<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyProgramCompetency
 *
 * @ORM\Table(name="kompetensi_program_studi")
 * @ORM\Entity
 */

class StudyProgramCompetency
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
     * @var StudyProgram
     *
     * @ORM\ManyToOne(targetEntity="StudyProgram", inversedBy="studyProgramCompetency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="program_studi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $studyProgram;

    /**
     * @var Competency
     *
     * @ORM\ManyToOne(targetEntity="Competency", inversedBy="studyProgramCompetency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kompetensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $competency;

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
     * @return StudyProgram
     */
    public function getStudyProgram(): StudyProgram
    {
        return $this->studyProgram;
    }

    /**
     * @param StudyProgram $studyProgram
     */
    public function setStudyProgram(StudyProgram $studyProgram): void
    {
        $this->studyProgram = $studyProgram;
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
}
