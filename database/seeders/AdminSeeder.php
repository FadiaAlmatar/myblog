<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
                'name' =>'fadia',
                'email' =>'fadia@gmail.com',
                'password'=>bcrypt('12345678'),
                'profile_img' => 'p.jpg',
                'is_admin' => true
            ]
        );
    }
}
