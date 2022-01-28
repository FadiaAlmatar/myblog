<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create(
            [
                'name' =>'Food',
                'slug' =>'Food'
            ]
        );
        \App\Models\Category::create(
          [
              'name' =>'Shopping',
              'slug' =>'Shopping'
          ]
      );
      \App\Models\Category::create(
          [
              'name' =>'Technology',
              'slug' =>'Technology'
          ]
      );
      \App\Models\Category::create(
          [
              'name' =>'Weather',
              'slug' =>'Weather'
          ]
      );
      \App\Models\Category::create(
          [
              'name' =>'Art',
              'slug' =>'Art'
          ]
      );

    }
}
