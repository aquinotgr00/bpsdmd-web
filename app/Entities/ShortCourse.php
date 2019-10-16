<?php

namespace App\Entities;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="diklats")
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
     * Get diklat by type
     * @param string $type
     * @return ShortCourse[]
     */
    public function getShortCourseByType($type = 'all')
    {
        if ($type == ShortCourse::TYPE_DPM) {
            return $this->getRepository()->findBy(['type' => ShortCourse::TYPE_DPM]);
        } elseif ($type == ShortCourse::TYPE_TEKNIS) {
            return $this->getRepository()->findBy(['type' => ShortCourse::TYPE_TEKNIS]);
        }

        return $this->getRepository()->findAll();
    }
}
