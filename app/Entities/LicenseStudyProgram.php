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
     * @var string
     *
     * @ORM\Column(name="id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var License
     *
     * @ORM\ManyToOne(targetEntity="License", inversedBy="licenseStudyProgram")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lisensi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $license;

    /**
     * @var StudyProgram
     *
     * @ORM\ManyToOne(targetEntity="StudyProgram", inversedBy="licenseStudyProgram")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="program_studi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $studyProgram;

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
