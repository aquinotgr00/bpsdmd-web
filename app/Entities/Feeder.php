<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feeder
 *
 * @ORM\Table(name="feeder")
 * @ORM\Entity
 */
class Feeder
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
     * @var string
     *
     * @ORM\Column(name="nama_file", type="string", nullable=false)
     */
    private $filename;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="feeders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pengguna_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt = NULL;


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
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
