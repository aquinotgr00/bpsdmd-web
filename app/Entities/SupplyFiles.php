<?php

namespace App\Entities;

use App\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * SupplyFiles
 *
 * @ORM\Table(name="supply_files")
 * @ORM\Entity
 */
class SupplyFiles
{
    const UPLOAD_PATH = 'files/';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", nullable=true)
     */
    private $file_name = 'NULL';

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uploaded_by", referencedColumnName="iduser", onDelete="RESTRICT")
     * })
     */

    private $uploaded_by = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", nullable=true)
     */
    private $created_at = 'NULL';

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="org_id", referencedColumnName="idorg", onDelete="RESTRICT")
     * })
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
     * @return int
     */
    public function getUploadedBy(): User
    {
        if (is_null($this->uploaded_by)) {
            return new User;
        }

        return $this->uploaded_by;
    }

    /**
     * @param string $uploaded_by
     */
    public function setUploadedBy(User $uploaded_by): void
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
    public function getOrg(): Organization
    {
        if (is_null($this->org_id)) {
            return new Organization;
        }

        return $this->org_id;
    }


    /**
     * @param int $org_id
     */
    public function setOrg(Organization $org_id): void
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

    /**
     * @return User[]|ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

}
