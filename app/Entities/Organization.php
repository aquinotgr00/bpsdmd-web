<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="dataorg")
 * @ORM\Entity
 */
class Organization
{
    const TYPE_SUPPLY = 'supply';
    const TYPE_DEMAND = 'demand';

    /**
     * @var integer
     *
     * @ORM\Column(name="idorg", type="integer", nullable=false)
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
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var ArrayCollection|User[]
     * @ORM\OneToMany(targetEntity="User", mappedBy="org")
     */
    private $users;

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
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return User[]|ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User[]|ArrayCollection $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    public function getAvailableTypes()
    {
        return [self::TYPE_SUPPLY, self::TYPE_DEMAND];
    }
}
