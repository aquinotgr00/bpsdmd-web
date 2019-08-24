<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", nullable=true)
     */
    private $username = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=true)
     */
    private $password = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="authority", type="string", nullable=true)
     */
    private $authority = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="org", type="integer", nullable=true)
     */
    private $org;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    private $photo = 'NULL';

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
    public function getUsername(): string
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = \Hash::make($password);
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
    public function setAuthority(string $authority): void
    {
        $this->authority = $authority;
    }

    /**
     * @return int
     */
    public function getOrg(): int
    {
        return $this->org;
    }

    /**
     * @param int $org
     */
    public function setOrg(int $org): void
    {
        $this->org = $org;
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
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    public function getAvailableRoles()
    {
        return [self::ROLE_ADMIN, self::ROLE_SUPPLY, self::ROLE_DEMAND];
    }
}
