<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Hash;

/**
 * User
 *
 * @ORM\Table(name="pengguna")
 * @ORM\Entity
 */
class User implements UserInterface
{
    const ROLE_ADMIN = 'administrator';
    const ROLE_SUPPLY = 'supply';
    const ROLE_DEMAND = 'demand';
    const UPLOAD_PATH = 'users/img';
    const LOCALE_ID = 'id';
    const LOCALE_EN = 'en';

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
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instansi_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $org = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="otoritas", type="string", nullable=false)
     */
    private $authority;

    /**
     * @var string
     *
     * @ORM\Column(name="aktif", type="string", nullable=false)
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="hapus", type="string", nullable=false)
     */
    private $isDeleted;

    /**
     * @var string
     *
     * @ORM\Column(name="nama", type="string", nullable=true)
     */
    private $name = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", nullable=true)
     */
    private $photo = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="bahasa", type="string", nullable=false)
     */
    private $locale = 'id';

    /**
     * @var ArrayCollection|Feeder[]
     * @ORM\OneToMany(targetEntity="Feeder", mappedBy="user")
     */
    private $feeders;

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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = Hash::make($password);
    }

    /**
     * @return string
     */
    public function getAuthority(): ?string
    {
        return $this->authority;
    }

    /**
     * @param string $authority
     */
    public function setAuthority($authority): void
    {
        $this->authority = $authority;
    }

    /**
     * @return string
     */
    public function getIsActive(): string
    {
        return $this->isActive;
    }

    /**
     * @param string $isActive
     */
    public function setIsActive(string $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getIsDeleted(): string
    {
        return $this->isDeleted;
    }

    /**
     * @param string $isDeleted
     */
    public function setIsDeleted(string $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
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
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return Feeder[]|ArrayCollection
     */
    public function getFeeders()
    {
        return $this->feeders;
    }

    /**
     * @param Feeder[]|ArrayCollection $feeders
     */
    public function setFeeders($feeders): void
    {
        $this->feeders = $feeders;
    }
}
