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
        DB::table('datauser')->truncate();

        $user = new \App\Entities\User;
        $user->setId(1);
        $user->setUsername('bpsdm');
        $user->setPassword('bpsdm');
        $user->setAuthority(\App\Entities\User::ROLE_ADMIN);

        EntityManager::persist($user);
        EntityManager::flush();
    }
}
