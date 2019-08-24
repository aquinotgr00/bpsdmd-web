<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="supply_files")
 * @ORM\Entity
 */
class SupplyFiles 
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", nullable=true)
     */
    private $file_name = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="uploaded_by", type="string", nullable=true)
     */
    private $uploaded_by = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", nullable=true)
     */
    private $created_at = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $org_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    private $path;

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
    public function getFileName(): string
    {
        return $this->file_name;
    }

    /**
     * @param string $file_name
     */
    public function setFileName(string $file_name): void
    {
        $this->file_name = $file_name;
    }

    /**
     * @return string
     */
    public function getUploadedBy(): string
    {
        return $this->uploaded_by;
    }

    /**
     * @param string $uploaded_by
     */
    public function setUploadedBy(string $uploaded_by): void
    {
        $this->uploaded_by = $uploaded_by;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getOrgId(): int
    {
        return $this->org_id;
    }

    /**
     * @param int $org_id
     */
    public function setOrgId(int $org_id): void
    {
        $this->org_id = $org_id;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param int $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}
