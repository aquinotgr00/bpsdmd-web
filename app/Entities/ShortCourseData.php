<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShortCourseData
 *
 * @ORM\Table(name="data_diklat")
 * @ORM\Entity
 */
class ShortCourseData
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
     * @var ShortCourse
     *
     * @ORM\ManyToOne(targetEntity="ShortCourse", inversedBy="shortCourseData")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diklat_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $shortCourse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_mulai", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_selesai", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="target_jumlah_peserta", type="integer", nullable=true)
     */
    private $totalTarget = NULL;

    /**
     * @var integer
     *
     * @ORM\Column(name="realisasi_jumlah_peserta", type="integer", nullable=true)
     */
    private $totalRealization = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="sk_buka", type="string", nullable=true)
     */
    private $openSk = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="sk_tutup", type="string", nullable=true)
     */
    private $closeSk = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="angkatan", type="string", nullable=true)
     */
    private $generation = NULL;

    /**
     * @var integer
     *
     * @ORM\Column(name="tahun", type="integer", nullable=true)
     */
    private $year = NULL;

    /**
     * @var integer
     *
     * @ORM\Column(name="lama_diklat", type="integer", nullable=true)
     */
    private $shortCourseTime = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="tempat", type="string", nullable=true)
     */
    private $place = NULL;

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
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */
    public function getTotalTarget()
    {
        return $this->totalTarget;
    }

    /**
     * @param int $totalTarget
     */
    public function setTotalTarget($totalTarget): void
    {
        $this->totalTarget = $totalTarget;
    }

    /**
     * @return int
     */
    public function getTotalRealization()
    {
        return $this->totalRealization;
    }

    /**
     * @param int $totalRealization
     */
    public function setTotalRealization($totalRealization): void
    {
        $this->totalRealization = $totalRealization;
    }

    /**
     * @return string
     */
    public function getOpenSk(): ?string
    {
        return $this->openSk;
    }

    /**
     * @param string $requirement
     */
    public function setOpenSk($openSk): void
    {
        $this->openSk = $openSk;
    }

    /**
     * @return string
     */
    public function getCloseSk(): ?string
    {
        return $this->closeSk;
    }

    /**
     * @param string $closeSk
     */
    public function setCloseSk($closeSk): void
    {
        $this->closeSk = $closeSk;
    }

    /**
     * @return string
     */
    public function getGeneration()
    {
        return $this->generation;
    }

    /**
     * @param string $generation
     */
    public function setGeneration($generation): void
    {
        $this->generation = $generation;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getShortCourseTime()
    {
        return $this->shortCourseTime;
    }

    /**
     * @param int $shortCourseTime
     */
    public function setShortCourseTime($shortCourseTime): void
    {
        $this->shortCourseTime = $shortCourseTime;
    }

    /**
     * @return string
     */
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace($place): void
    {
        $this->place = $place;
    }

    /**
     * @return string
     */
    public function getPeriod(): ?string
    {
        return $this->outcomeDiklat;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period): void
    {
        $this->period = $period;
    }
}
