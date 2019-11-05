<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * District
 *
 * @ORM\Table(name="kabupaten")
 * @ORM\Entity
 */
class District
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
     * @var Province
     *
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="districts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provinsi_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $province = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=false)
     */
    private $code;

    /**
     * @var ArrayCollection|ShortCourseParticipant[]
     * @ORM\OneToMany(targetEntity="ShortCourseParticipant", mappedBy="district")
     */
    private $shortCourseParticipants;

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
     * @return Province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param Province $province
     */
    public function setProvince(Province $province): void
    {
        $this->province = $province;
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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
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
}
