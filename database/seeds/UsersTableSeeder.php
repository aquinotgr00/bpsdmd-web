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
        DB::table('pengguna')->truncate();

        $data = [
            [
                'email' => 'admin@bpsdm.com',
                'password' => 'bpsdm',
                'authority' => \App\Entities\User::ROLE_ADMIN,
                'isActive' => 1,
                'org' => false,
                'name' => 'Admin BPSDM'
            ],
            [
                'email' => 'user@pelni.com',
                'password' => 'pelni',
                'authority' => \App\Entities\User::ROLE_DEMAND,
                'isActive' => 1,
                'org' => $orgService->getRepository()->find(1),
                'name' => 'User PELNI'
            ],
            [
                'email' => 'user@kai.com',
                'password' => 'kai',
                'authority' => \App\Entities\User::ROLE_DEMAND,
                'isActive' => 1,
                'org' => $orgService->getRepository()->find(2),
                'name' => 'User KAI'
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
