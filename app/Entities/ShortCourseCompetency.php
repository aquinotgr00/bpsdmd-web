<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShortCourseCompetency
 *
 * @ORM\Table(name="kompetensi_diklat")
 * @ORM\Entity
 */
class ShortCourseCompetency
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
     * @var ShortCourse
     *
     * @ORM\ManyToOne(targetEntity="ShortCourse", inversedBy="shortCourseCompetency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diklat_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $shortCourse;

    /**
     * @var Competency
     *
     * @ORM\ManyToOne(targetEntity="Competency", inversedBy="shortCourseCompetency")
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
     * @return ShortCourse
     */
    public function getShortCourse(): ShortCourse
    {
        return $this->shortCourse;
    }

    /**
     * @param ShortCourse $shortCourse
     */
    public function setShortCourse(ShortCourse $shortCourse): void
    {
        $this->shortCourse = $shortCourse;
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
