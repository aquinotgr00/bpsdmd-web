<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * JobTitle
 *
 * @ORM\Table(name="jabatan")
 * @ORM\Entity
 */
class JobTitle
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
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="students")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $org;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var ArrayCollection|Recruitment[]
     * @ORM\OneToMany(targetEntity="Recruitment", mappedBy="jobTitle")
     */
    private $recruitment;

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
    public function getOrg(): Organization
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
     * @return Recruitment[]|ArrayCollection
     */
    public function getRecruitment()
    {
        return $this->recruitment;
    }

    /**
     * @param Recruitment[]|ArrayCollection $recruitment
     */
    public function setRecruitment($recruitment): void
    {
        $this->recruitment = $recruitment;
    }
}
