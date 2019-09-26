<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \App\Services\Domain\OrgService $orgService */
        $orgService = app(\App\Services\Domain\OrgService::class);
        DB::table('organisasi')->truncate();

        $data = [
            [
                'name' => 'PELNI',
                'type' => \App\Entities\Organization::TYPE_DEMAND
            ],
            [
                'name' => 'KAI',
                'type' => \App\Entities\Organization::TYPE_DEMAND
            ]
        ];

        foreach ($data as $item) {
            $collection = new \Illuminate\Support\Collection($item);
            $orgService->create($collection, false);
        }

        EntityManager::flush();
    }
}
