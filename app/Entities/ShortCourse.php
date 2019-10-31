<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ShortCourse
 *
 * @ORM\Table(name="diklat")
 * @ORM\Entity
 */
class ShortCourse
{
    const TYPE_DPM = 'dpm';
    const TYPE_TEKNIS = 'teknis';
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="shortCourses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $org = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="tipe", type="string", nullable=false)
     */
    private $type;

    /**
     * @var ArrayCollection|ShortCourseData[]
     * @ORM\OneToMany(targetEntity="ShortCourseData", mappedBy="shortCourse")
     */
    private $shortCourseData;

    /**
     * @var ArrayCollection|ShortCourseParticipant[]
     * @ORM\OneToMany(targetEntity="ShortCourseParticipant", mappedBy="shortCourse")
     */
    private $shortCourseParticipants;

    /**
     * @var ArrayCollection|ShortCourseCompetency[]
     * @ORM\OneToMany(targetEntity="ShortCourseCompetency", mappedBy="shortCourse")
     */
    private $shortCourseCompetency;

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
     * @return Organization
     */
    public function getOrg()
    {
        return $this->org;
    }

    /**
     * @param Organization $org
     */
    public function setOrg(Organization $org): void
    {
        $this->org = $org;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
     * @return ShortCourseData[]|ArrayCollection
     */
    public function getShortCourseData()
    {
        return $this->shortCourseData;
    }

    /**
     * @param ShortCourseData[]|ArrayCollection $shortCourseData
     */
    public function setShortCourseData($shortCourseData): void
    {
        $this->shortCourseData = $shortCourseData;
    }

    /**
     * @return ShortCourseParticipant[]|ArrayCollection
     */
    public function getShortCourseParticipants()
    {
        return $this->shortCourseParticipants;
    }

    /**
     * @param ShortCourseParticipant[]|ArrayCollection $shortCourseParticipants
     */
    public function setShortCourseParticipants($shortCourseParticipants): void
    {
        $this->shortCourseParticipants = $shortCourseParticipants;
    }

    /**
     * @return ShortCourseCompetency[]|ArrayCollection
     */
    public function getShortCourseCompetency()
    {
        return $this->shortCourseCompetency;
    }

    /**
     * @param ShortCourseCompetency[]|ArrayCollection $shortCourseCompetency
     */
    public function setShortCourseCompetency($shortCourseCompetency): void
    {
        $this->shortCourseCompetency = $shortCourseCompetency;
    }
}
