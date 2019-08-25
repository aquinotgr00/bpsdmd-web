<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \App\Services\Domain\UserService $userService */
        $userService = app(\App\Services\Domain\UserService::class);
        /** @var \App\Services\Domain\OrgService $orgService */
        $orgService = app(\App\Services\Domain\OrgService::class);
        DB::table('datauser')->truncate();

        $data = [
            [
                'username' => 'bpsdm',
                'password' => 'bpsdm',
                'authority' => \App\Entities\User::ROLE_ADMIN,
                'org' => false
            ],
            [
                'username' => 'supply',
                'password' => 'supply',
                'authority' => \App\Entities\User::ROLE_SUPPLY,
                'org' => $orgService->getRepository()->find(1)
            ],
            [
                'username' => 'demand',
                'password' => 'demand',
                'authority' => \App\Entities\User::ROLE_DEMAND,
                'org' => $orgService->getRepository()->find(2)
            ],
        ];

        foreach ($data as $item) {
            $org = $item['org'];
            unset($item['org']);

            $collection = new \Illuminate\Support\Collection($item);
            $userService->create($collection, $org, false);
        }

        EntityManager::flush();
    }
}
