<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
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
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="org_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     */
    private $org;

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
     * @var integer
     *
     * @ORM\Column(name="aktif", type="integer", nullable=false)
     */
    private $isActive = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="hapus", type="integer", nullable=false)
     */
    private $isDeleted = 0;

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
    public function getEmail(): string
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getAuthority(): string
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
     * @return int
     */
    public function getIsActive(): int
    {
        return $this->isActive;
    }

    /**
     * @param int $isActive
     */
    public function setIsActive(int $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getIsDeleted(): int
    {
        return $this->isDeleted;
    }

    /**
     * @param int $isDeleted
     */
    public function setIsDeleted(int $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return string
     */
    public function getName(): string
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
    public function getPhoto(): string
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
}
