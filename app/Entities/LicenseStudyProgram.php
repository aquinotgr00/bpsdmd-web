<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * LicenseStudyProgram
 *
 * @ORM\Table(name="lisensi_program_studi")
 * @ORM\Entity
 */
class LicenseStudyProgram
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
     * @var License
     *
     * @ORM\ManyToOne(targetEntity="License", inversedBy="licenseStudyProgram", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lisensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $license;

    /**
     * @var StudyProgram
     *
     * @ORM\ManyToOne(targetEntity="StudyProgram", inversedBy="licenseStudyProgram",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="program_studi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $studyProgram;

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
}
