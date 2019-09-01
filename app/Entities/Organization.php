<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="dataref_msunit")
 * @ORM\Entity
 */
class Organization
{
    const TYPE_SUPPLY = 'supply';
    const TYPE_DEMAND = 'demand';

    /**
     * @var string
     *
     * @ORM\Column(name="idunit", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="parentunit", type="string", nullable=false)
     */
    private $parentUnit;


    /**
     * @var string
     *
     * @ORM\Column(name="namaunit", type="string", nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="levelunit", type="integer", nullable=true)
     */
    private $levelunit;

    /**
     * @var string
     *
     * @ORM\Column(name="alamatunit", type="string", nullable=true)
     */
    private $alamat;

    /**
     * @var string
     *
     * @ORM\Column(name="namasingkat", type="string", nullable=true)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="telepon", type="string", nullable=true)
     */
    private $phone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="t_updateuser", type="string", nullable=true)
     */
    private $updateUser;

    /**
     * @var string
     *
     * @ORM\Column(name="t_updatetime", type="string", nullable=true)
     */
    private $updateTime;
    
    /**
     * @var string
     *
     * @ORM\Column(name="t_updateip", type="string", nullable=true)
     */
    private $updateIp;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="softdelete", type="integer", nullable=true)
     */
    private $softDelete;
    
    /**
     * @var string
     *
     * @ORM\Column(name="idjenjang", type="string", nullable=true)
     */
    private $idJenjang;

    /**
     * @var string
     *
     * @ORM\Column(name="namauniten", type="string", nullable=true)
     */
    private $namaUnitEn;
    
        /**
     * @var string
     *
     * @ORM\Column(name="akreditasi", type="string", nullable=true)
     */
    private $akreditasi;
    
    /**
     * @var string
     *
     * @ORM\Column(name="skakreditasi", type="string", nullable=true)
     */
    private $skAkreditasi;

    /**
     * @var string
     *
     * @ORM\Column(name="idSatker", type="string", nullable=true)
     */
    private $idSatker;

    /**
     * @var string
     *
     * @ORM\Column(name="skslulusmin", type="string", nullable=true)
     */
    private $sksLulusMin;

    /**
     * @var string
     *
     * @ORM\Column(name="gelar", type="string", nullable=true)
     */
    private $gelar;

    /**
     * @var string
     *
     * @ORM\Column(name="deskGelar", type="string", nullable=true)
     */
    private $deskGelar;

    /**
     * @var string
     *
     * @ORM\Column(name="ipklulusmin", type="string", nullable=true)
     */
    private $IpkLulusMin;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="idkota", type="string", nullable=true)
     */
    private $idKota;

    /**
     * @var string
     *
     * @ORM\Column(name="kodenim", type="string", nullable=true)
     */
    private $kodeNim;

    /**
     * @var integer
     *
     * @ORM\Column(name="idunitsdm", type="integer", nullable=true)
     */
    private $idUnitSdm;

    /**
     * @var string
     *
     * @ORM\Column(name="kodeunit", type="string", nullable=true)
     */
    private $kodeUnit;


    /**
     * @var string
     *
     * @ORM\Column(name="tipe", type="string", nullable=false)
     */
    private $type;

    /**
     * @var ArrayCollection|User[]
     * @ORM\OneToMany(targetEntity="User", mappedBy="org")
     */
    private $users;

    /**
     * @var ArrayCollection|SupplyFiles[]
     * @ORM\OneToMany(targetEntity="SupplyFiles", mappedBy="org_id")
     */
    private $files;

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

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }

    /**
     * @return SupplyFiles[]|ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param SupplyFiles[]|ArrayCollection $files
     */
    public function setFiles($files): void
    {
        $this->files = $files;
    }

    public function getAvailableTypes()
    {
        return [self::TYPE_SUPPLY, self::TYPE_DEMAND];
    }


    /**
     * @return integer
     */
    public function getLevelUnit()
    {
        return $this->levelnit;
    }

    /**
     * @param integer $levelnit
     *
     * @return self
     */
    public function setLevelUnit($levelnit)
    {
        $this->levelnit = $levelnit;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * @param string $alamat
     *
     * @return self
     */
    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;

        return $this;
    }


    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdateUser()
    {
        return $this->updateUser;
    }

    /**
     * @param string $updateUser
     *
     * @return self
     */
    public function setUpdateUser($updateUser)
    {
        $this->updateUser = $updateUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param string $updateTime
     *
     * @return self
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdateIp()
    {
        return $this->updateIp;
    }

    /**
     * @param string $updateIp
     *
     * @return self
     */
    public function setUpdateIp($updateIp)
    {
        $this->updateIp = $updateIp;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSoftDelete()
    {
        return $this->softDelete;
    }

    /**
     * @param integer $softDelete
     *
     * @return self
     */
    public function setSoftDelete($softDelete)
    {
        $this->softDelete = $softDelete;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdJenjang()
    {
        return $this->idJenjang;
    }

    /**
     * @param string $idJenjang
     *
     * @return self
     */
    public function setIdJenjang($idJenjang)
    {
        $this->idJenjang = $idJenjang;

        return $this;
    }

    /**
     * @return string
     */
    public function getNamaUnitEn()
    {
        return $this->namaUnitEn;
    }

    /**
     * @param string $namaUnitEn
     *
     * @return self
     */
    public function setNamaUnitEn($namaUnitEn)
    {
        $this->namaUnitEn = $namaUnitEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getAkreditasi()
    {
        return $this->akreditasi;
    }

    /**
     * @param string $akreditasi
     *
     * @return self
     */
    public function setAkreditasi($akreditasi)
    {
        $this->akreditasi = $akreditasi;

        return $this;
    }

    /**
     * @return string
     */
    public function getSkAkreditasi()
    {
        return $this->skAkreditasi;
    }

    /**
     * @param string $skAkreditasi
     *
     * @return self
     */
    public function setSkAkreditasi($skAkreditasi)
    {
        $this->skAkreditasi = $skAkreditasi;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdSatker()
    {
        return $this->idSatker;
    }

    /**
     * @param string $idSatker
     *
     * @return self
     */
    public function setIdSatker($idSatker)
    {
        $this->idSatker = $idSatker;

        return $this;
    }

    /**
     * @return string
     */
    public function getSksLulusMin()
    {
        return $this->sksLulusMin;
    }

    /**
     * @param string $sksLulusMin
     *
     * @return self
     */
    public function setSksLulusMin($sksLulusMin)
    {
        $this->sksLulusMin = $sksLulusMin;

        return $this;
    }

    /**
     * @return string
     */
    public function getGelar()
    {
        return $this->gelar;
    }

    /**
     * @param string $gelar
     *
     * @return self
     */
    public function setGelar($gelar)
    {
        $this->gelar = $gelar;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeskGelar()
    {
        return $this->deskGelar;
    }

    /**
     * @param string $deskGelar
     *
     * @return self
     */
    public function setDeskGelar($deskGelar)
    {
        $this->deskGelar = $deskGelar;

        return $this;
    }

    /**
     * @return string
     */
    public function getIpkLulusMin()
    {
        return $this->ipkLulusMin;
    }

    /**
     * @param string $ipkLulusMin
     *
     * @return self
     */
    public function setIpkLulusMin($IpkLulusMin)
    {
        $this->ipkLulusMin = $ipkLulusMin;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     *
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdKota()
    {
        return $this->idKota;
    }

    /**
     * @param string $idKota
     *
     * @return self
     */
    public function setIdKota($idKota)
    {
        $this->idKota = $idKota;

        return $this;
    }

    /**
     * @return string
     */
    public function getKodeNim()
    {
        return $this->kodeNim;
    }

    /**
     * @param string $kodeNim
     *
     * @return self
     */
    public function setKodeNim($kodeNim)
    {
        $this->kodeNim = $kodeNim;

        return $this;
    }

    /**
     * @return integer
     */
    public function getIdUnitSdm()
    {
        return $this->idUnitSdm;
    }

    /**
     * @param integer $idUnitSdm
     *
     * @return self
     */
    public function setIdUnitSdm($idUnitSdm)
    {
        $this->idUnitSdm = $idUnitSdm;

        return $this;
    }

    /**
     * @return string
     */
    public function getKodeUnit()
    {
        return $this->kodeUnit;
    }

    /**
     * @param string $kodeUnit
     *
     * @return self
     */
    public function setKodeUnit($kodeUnit)
    {
        $this->kodeUnit = $kodeUnit;

        return $this;
    }

    /**
     * @return string
     */
    public function getParentUnit()
    {
        return $this->parentUnit;
    }

    /**
     * @param string $parentUnit
     *
     * @return self
     */
    public function setParentUnit($parentUnit)
    {
        $this->parentUnit = $parentUnit;

        return $this;
    }
}
