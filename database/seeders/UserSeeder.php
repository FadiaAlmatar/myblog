<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(
            [
                'name' =>'mouner',
                'email' =>'mouner@gmail.com',
                'password'=>bcrypt('12345678'),
                'profile_img' => 'img/p.jpg',
            ]
        );
    }
}
