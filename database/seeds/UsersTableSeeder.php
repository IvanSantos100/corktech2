<?php

use CorkTech\Models\User;
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
        factory(User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'admin@corktech.com'
        ]);

        factory(User::class, 1)->create([
            'name' => 'User',
            'email' => 'user@corktech.com',
            'centrodistribuicao_id' => 2,
            'is_permission' => 2
        ]);

        factory(User::class, 1)->create([
            'name' => 'User2',
            'email' => 'user2@corktech.com',
            'centrodistribuicao_id' => 3,
            'is_permission' => 3
        ]);
    }
}
