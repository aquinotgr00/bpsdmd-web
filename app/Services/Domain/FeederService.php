<?php

namespace App\Services\Domain;

use App\Entities\Feeder;
use App\Entities\User;
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
        ->from(Feeder::class, $alias, $indexBy);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Feeder::class);
    }


    /**
     * Create new Feeder
     *
     * @param Collection $data
     * @param bool $flush
     * @return Feeder
     */
    public function create(Collection $data, $flush = true)
    {
        $feeder = new Feeder;
        $feeder->setFileName($data->get('filename'));
        $feeder->setStatus(0);
        $feeder->setCreatedAt(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('user') instanceof User) {
            $feeder->setUser($data->get('user'));
        }

        EntityManager::persist($feeder);

        if ($flush) {
            EntityManager::flush();

            return $feeder;
        }
    }

    /**
     * Update Feeder
     *
     * @param Feeder $feeder
     * @param Collection $data
     * @param bool $flush
     * @return Feeder
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Feeder $feeder, Collection $data, $flush = true)
    {
        $feeder->setFileName($data->get('filename'));
        $feeder->setStatus($data->get('status'));

        if ($data->get('user') instanceof User) {
            $feeder->setUser($data->get('user'));
        }

        EntityManager::persist($feeder);

        if ($flush) {
            EntityManager::flush();

            return $feeder;
        }
    }

    /**
     * Delete Feeder
     *
     * @param Feeder $feeder
     * @return bool
     * @throws ProgramDeleteException
     */
    public function delete(Feeder $feeder)
    {
        EntityManager::remove($feeder);
        EntityManager::flush();
    }

    /**
     * Find Feeder by id
     *
     * @param $id
     * @return Feeder
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Active Feeder
     *
     * @param Feeder $feeder
     */
    public function activeFeeder(Feeder $feeder)
    {
        $feeder->setStatus(1);

        EntityManager::persist($feeder);
        EntityManager::flush();
    }
}
