<?php

namespace App\Services\Domain;

use App\Entities\Organization;
use App\Entities\Student;
use App\Entities\StudyProgram;
use App\Exceptions\OrgDeleteException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EntityManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class OrgService
{
    use PaginatesFromParams;

    /**
     * @param $alias
     * @param null $indexBy
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return EntityManager::createQueryBuilder()
            ->select($alias)
            ->from(Organization::class, $alias, $indexBy);
    }

    /**
     * @param $dql
     * @return \Doctrine\ORM\Query
     */
    public function createQuery($dql)
    {
        return EntityManager::createQuery($dql);
    }

    /**
     * Instance repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository(Organization::class);
    }

    /**
     * Paginate organization
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateOrg($page): LengthAwarePaginator
    {
        $limit = 10;
        $query = $this->createQueryBuilder('o')
            ->getQuery();

        return $this->paginate($query, $limit, $page, false);
    }

    /**
     * Create new organization
     *
     * @param Collection $data
     * @param bool $flush
     * @return Organization
     */
    public function create(Collection $data, $flush = true)
    {
        $org = new Organization;
        $org->setIdDikti($data->get('id_dikti'));
        $org->setCode($data->get('code'));
        $org->setName($data->get('name'));
        $org->setShortName($data->get('short_name'));
        $org->setLetterOfEst($data->get('letter_of_est'));
        $org->setLetterOfOpr($data->get('letter_of_opr'));
        $org->setStatus($data->get('status'));
        $org->setType($data->get('type'));
        $org->setModa($data->get('moda'));
        $org->setAddress($data->get('address'));
        $org->setDescription($data->get('description'));
        $org->setPhoneNumber($data->get('phone_number'));
        $org->setFax($data->get('fax'));
        $org->setWebsite($data->get('website'));
        $org->setEmail($data->get('email'));
        $org->setOwnershipStatus($data->get('ownership_status'));
        $org->setUnderSupervision($data->get('under_supervision'));
        $org->setEducationType($data->get('education_type'));
        $org->setStatus($data->get('accreditation'));
        $org->setLastUpdate(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('date_of_est')) {
            $org->setDateOfEst(date_create_from_format('d-m-Y', $data->get('date_of_est')));
        }

        if ($data->get('date_of_opr')) {
            $org->setDateOfOpr(date_create_from_format('d-m-Y', $data->get('date_of_opr')));
        }

        if ($data->get('uploaded_img')) {
            $org->setPhoto($data->get('uploaded_img'));
        }

        EntityManager::persist($org);

        if ($flush) {
            EntityManager::flush();

            return $org;
        }
    }

    /**
     * Update organization
     *
     * @param Organization $org
     * @param Collection $data
     * @param bool $flush
     * @return Organization
     */
    public function update(Organization $org, Collection $data, $flush = true)
    {
        $org->setIdDikti($data->get('id_dikti'));
        $org->setCode($data->get('code'));
        $org->setName($data->get('name'));
        $org->setShortName($data->get('short_name'));
        $org->setLetterOfEst($data->get('letter_of_est'));
        $org->setLetterOfOpr($data->get('letter_of_opr'));
        $org->setStatus($data->get('status'));
        $org->setType($data->get('type'));
        $org->setModa($data->get('moda'));
        $org->setAddress($data->get('address'));
        $org->setDescription($data->get('description'));
        $org->setPhoneNumber($data->get('phone_number'));
        $org->setFax($data->get('fax'));
        $org->setWebsite($data->get('website'));
        $org->setEmail($data->get('email'));
        $org->setOwnershipStatus($data->get('ownership_status'));
        $org->setUnderSupervision($data->get('under_supervision'));
        $org->setEducationType($data->get('education_type'));
        $org->setStatus($data->get('accreditation'));
        $org->setLastUpdate(date_create_from_format('d-m-Y', date('d-m-Y')));

        if ($data->get('date_of_est')) {
            $org->setDateOfEst(date_create_from_format('d-m-Y', $data->get('date_of_est')));
        }

        if ($data->get('date_of_opr')) {
            $org->setDateOfOpr(date_create_from_format('d-m-Y', $data->get('date_of_opr')));
        }

        if ($data->get('uploaded_img')) {
            @unlink(public_path(Organization::UPLOAD_PATH).'/'.$org->getLogo());
            $org->setLogo($data->get('uploaded_img'));
        }

        EntityManager::persist($org);

        if ($flush) {
            EntityManager::flush();

            return $org;
        }
    }

    /**
     * Delete organization
     *
     * @param Organization $org
     * @return bool
     * @throws OrgDeleteException
     */
    public function delete(Organization $org)
    {
        $count_user = count($org->getUsers());
        $count_program = count($org->getPrograms());

        if (!$count_user && !$count_program) {
            EntityManager::remove($org);
            EntityManager::flush();

            return true;
        }

        throw new OrgDeleteException('Cannot delete organization due to existing ' . $count . ' users!');
    }

    /**
     * Find organization by id
     *
     * @param $id
     * @return Organization
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Get organization by type
     * @param string $type
     * @return Organization[]
     */
    public function getOrgByType($type = 'all')
    {
        if ($type == Organization::TYPE_DEMAND) {
            return $this->getRepository()->findBy(['type' => Organization::TYPE_DEMAND]);
        } elseif ($type == Organization::TYPE_SUPPLY) {
            return $this->getRepository()->findBy(['type' => Organization::TYPE_SUPPLY]);
        }

        return $this->getRepository()->findAll();
    }

    /**
     * Get count school
     *
     * @return int
     */
    public function getCountSchool()
    {
        try {
            $qb = $this->createQueryBuilder('org')
                ->select('count(org.id)')
                ->where('org.type = :type')
                ->setParameter('type', Organization::TYPE_SUPPLY);

            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get list school
     *
     * @return array
     */
    public function getSchoolAsList()
    {
        $result = [];
        $qb = $this->createQueryBuilder('org')
            ->where('org.type = :type')
            ->orderBy('org.name')
            ->setParameter('type', Organization::TYPE_SUPPLY);

        $schools = $qb->getQuery()->getResult();

        /** @var Organization $school */
        foreach ($schools as $school) {
            $result[$school->getId()] = $school->getName();
        }

        return $result;
    }

    /**
     * Get org and total students
     *
     * @return string
     */
    public function getGraphSchoolAndStudents()
    {
        $query = \DB::select('
        select i.nama, std.total as y
        from instansi i
        left join (
            select s.instansi_id, count(s.id) as total
            from siswa s
            group by s.instansi_id
        ) std ON std.instansi_id = i.id
        where std.total > 0
        order by y DESC
        ');

        return json_encode($query);
    }
}
