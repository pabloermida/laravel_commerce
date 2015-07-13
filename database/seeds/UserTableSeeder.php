<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->truncate();

        factory('CodeCommerce\User')->create(
            [
                'name' => 'Pablo',
                'email' => 'pablo.ermida@gmail.com',
                'password' => Hash::make(123456),
            ]

        );
        factory('CodeCommerce\User',10)->create();
    }
}