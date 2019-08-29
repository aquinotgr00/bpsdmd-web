<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Hash;

/**
 * User
 *
 * @ORM\Table(name="datauser")
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
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="authority", type="string", nullable=false)
     */
    private $authority;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    private $photo = 'NULL';

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="org", referencedColumnName="idorg", onDelete="RESTRICT")
     * })
     */
    private $org;

    /**
     * @var integer
     *
     * @ORM\Column(name="isactive", type="integer", nullable=false)
     */
    private $isActive = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="isdelete", type="integer", nullable=false)
     */
    private $isDelete = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
    public function setPassword(string $password): void
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
    public function setAuthority(string $authority): void
    {
        $this->authority = $authority;
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
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
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
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Organization
     */
    public function getOrg(): Organization
    {
        if (is_null($this->org)) {
            return new Organization;
        }

        return $this->org;
    }

    /**
     * @param Organization $org
     */
    public function setOrg(Organization $org): void
    {
        $this->org = $org;
    }

    public function getAvailableRoles()
    {
        return [self::ROLE_ADMIN, self::ROLE_SUPPLY, self::ROLE_DEMAND];
    }

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param int $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * @param int $isActicve
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;
    }
}
