<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="dosen")
 * @ORM\Entity
 */
class Teacher
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
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="teachers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $org = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nip", type="string", nullable=true)
     */
    private $nip = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="gelar_depan", type="string", nullable=true)
     */
    private $frontDegree = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="gelar_belakang", type="string", nullable=true)
     */
    private $backDegree = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tanggal_lahir", type="date", nullable=true)
     */
    private $dateOfBirth = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="no_ktp", type="string", nullable=true)
     */
    private $identityNumber = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="nidn", type="string", nullable=true)
     */
    private $nidn = NULL;

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
    public function getNip(): ?string
    {
        return $this->nip;
    }

    /**
     * @param string $nip
     */
    public function setNip($nip): void
    {
        $this->nip = $nip;
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
    public function getFrontDegree(): ?string
    {
        return $this->frontDegree;
    }

    /**
     * @param string $frontDegree
     */
    public function setFrontDegree($frontDegree): void
    {
        $this->frontDegree = $frontDegree;
    }

    /**
     * @return string
     */
    public function getBackDegree(): ?string
    {
        return $this->backDegree;
    }

    /**
     * @param string $backDegree
     */
    public function setBackDegree($backDegree): void
    {
        $this->backDegree = $backDegree;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth(\DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string
     */
    public function getIdentityNumber(): ?string
    {
        return $this->identityNumber;
    }

    /**
     * @param string $identityNumber
     */
    public function setIdentityNumber($identityNumber): void
    {
        $this->identityNumber = $identityNumber;
    }

    /**
     * @return string
     */
    public function getNidn(): ?string
    {
        return $this->nidn;
    }

    /**
     * @param string $nidn
     */
    public function setNidn($nidn): void
    {
        $this->nidn = $nidn;
    }
}
