<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DataDiklat
 *
 * @ORM\Table(name="data_diklat")
 * @ORM\Entity
 */
class DataDiklat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Diklat
     *
     * @ORM\ManyToOne(targetEntity="Diklat", inversedBy="diklats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diklat_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $diklat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_mulai", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_selesai", type="date", nullable=false)
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
     * @ORM\Column(name="syarat_peserta", type="string", nullable=true)
     */
    private $requirement = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="target_peserta", type="string", nullable=true)
     */
    private $target = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="output_diklat", type="string", nullable=true)
     */
    private $outputDiklat = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="outcome_diklat", type="string", nullable=true)
     */
    private $outcomeDiklat = NULL;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sk_buka", type="string", nullable=true)
     */
    private $sk_buka = NULL;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sk_tutup", type="string", nullable=true)
     */
    private $sk_tutup = NULL;
    
    /**
     * @var string
     *
     * @ORM\Column(name="angkatan", type="string", nullable=true)
     */
    private $generation = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="tahun", type="string", nullable=true)
     */
    private $year = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="lama_diklat", type="string", nullable=true)
     */
    private $period = NULL;

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
     * @return Diklat
     */
    public function getDiklat(): Diklat
    {
        return $this->diklat;
    }

    /**
     * @param Diklat $diklat
     */
    public function setDiklat(Diklat $diklat): void
    {
        $this->diklat = $diklat;
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
    public function getRequirement(): ?string
    {
        return $this->requirement;
    }

    /**
     * @param string $requirement
     */
    public function setRequirement($requirement): void
    {
        $this->requirement = $requirement;
    }

    /**
     * @return string
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget($target): void
    {
        $this->target = $target;
    }

    /**
     * @return string
     */
    public function getOutputDiklat(): ?string
    {
        return $this->outputDiklat;
    }

    /**
     * @param string $requirement
     */
    public function setOutputDiklat($outputDiklat): void
    {
        $this->outputDiklat = $outputDiklat;
    }

    /**
     * @return string
     */
    public function getOutcomeDiklat(): ?string
    {
        return $this->outcomeDiklat;
    }

    /**
     * @param string $outcomeDiklat
     */
    public function setOutcomeDiklat($outcomeDiklat): void
    {
        $this->outcomeDiklat = $outcomeDiklat;
    }

    /**
     * @return string
     */
    public function getSkBuka(): ?string
    {
        return $this->sk_buka;
    }

    /**
     * @param string $sk_buka
     */
    public function setSkBuka($sk_buka): void
    {
        $this->sk_buka = $sk_buka;
    }

    /**
     * @return string
     */
    public function getSkTutup(): ?string
    {
        return $this->sk_tutup;
    }

    /**
     * @param string $sk_tutup
     */
    public function setSkTutup($sk_tutup): void
    {
        $this->sk_tutup = $sk_tutup;
    }

    /**
     * @return string
     */
    public function getGeneration(): ?string
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
     * @return string
     */
    public function getYear(): ?string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
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
}
