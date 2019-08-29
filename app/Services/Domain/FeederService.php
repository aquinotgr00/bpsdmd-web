<?php

namespace App\Services\Domain;

use App\Entities\SupplyFiles;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Support\Collection;

class FeederService
{

    /**
     * @param $alias
     * @param null $indexBy
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return EntityManager::createQueryBuilder()
        ->select($alias)
        ->from(SupplyFiles::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(SupplyFiles::class);
    }


    /**
     * Create new Feeder
     *
     * @param Collection $data
     * @param bool $flush
     * @return SupplyFiles
     */
    public function create(Collection $data, $flush = true)
    {
        $supplyFiles = new SupplyFiles;
        $supplyFiles->setFileName($data->get('file_name'));
        $supplyFiles->setUploadedBy($data->get('upload_by'));
        $supplyFiles->setCreatedAt($data->get('created_at'));
        $supplyFiles->setOrg($data->get('org'));
        $supplyFiles->setPath($data->get('path'));
        EntityManager::persist($supplyFiles);

        if ($flush) {
            EntityManager::flush();

            return $supplyFiles;
        }
    }

    /**
     * Update Feeder
     *
     * @param SupplyFiles $org
     * @param Collection $data
     * @param bool $flush
     * @return SupplyFiles
     */
    public function update(SupplyFiles $supplyFiles, Collection $data, $flush = true)
    {
        $supplyFiles->setFileName($data->get('file_name'));
        $supplyFiles->setUploadedBy($data->get('upload_by'));
        $supplyFiles->setCreatedAt($data->get('created_at'));
        $supplyFiles->setOrg($data->get('org'));
        $supplyFiles->setPath($data->get('path'));
        EntityManager::persist($supplyFiles);

        if ($flush) {
            EntityManager::flush();

            return $supplyFiles;
        }
    }
}
