<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * StudyProgram
 *
 * @ORM\Table(name="program_studi")
 * @ORM\Entity
 */
class StudyProgram
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
     * @var string
     *
     * @ORM\Column(name="org_id", type="string", nullable=false)
     * @ORM\org_id
     */
    private $org_id;

    /**
     * @var string
     *
     * @ORM\Column(name="kode", type="string", nullable=true)
     */
    private $code = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="jenjang", type="string", nullable=false)
     */
    private $jenjang;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getOrg_id(): ?string
    {
        return $this->org_id;
    }

    /**
     * @param string $org_id
     */
    public function setOrg_id($org_id): void
    {
        $this->org_id = $org_id;
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
    public function getJenjang(): ?string
    {
        return $this->jenjang;
    }

    /**
     * @param string $jenjang
     */
    public function setJenjang($jenjang): void
    {
        $this->jenjang = $jenjang;
    }
}
