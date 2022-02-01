<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::create(
            [
                'title' =>'my favourite restaurant',
                'slug' =>Str::slug('my favourite restaurant'),
                'body' =>'my favourite restaurant',
                'image'=>'img/p.jpg',
                'date' => '2022-01-30',
                'user_id' => 1,
                'category_id'=>2,
                'status'=>1// active
            ]
        );
        \App\Models\Post::create(
            [
                'title' =>'weather for today',
                'slug' =>Str::slug('weather for today'),
                'body' =>'weather for today',
                'image'=>'img/p.jpg',
                'date' => '2022-01-30',
                'user_id' => 1,
                'category_id'=>1,
                'status'=>1// active
            ]
        );
        \App\Models\Post::create(
            [
                'title' =>'laravel and vue',
                'slug' =>Str::slug('laravel and vue'),
                'body' =>'laravel and vue',
                'image'=>'img/p.jpg',
                'date' => '2022-01-30',
                'user_id' => 1,
                'category_id'=>3,
                'status'=>1// active
            ]
        );
    }
}
