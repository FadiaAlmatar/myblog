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
                'image'=>'p.jpg',
                'user_id' => 1,
                'category_id'=>2
            ]
        );
        \App\Models\Post::create(
            [
                'title' =>'weather for today',
                'slug' =>Str::slug('weather for today'),
                'body' =>'weather for today',
                'image'=>'p.jpg',
                'user_id' => 1,
                'category_id'=>1
            ]
        );
        \App\Models\Post::create(
            [
                'title' =>'laravel and vue',
                'slug' =>Str::slug('laravel and vue'),
                'body' =>'laravel and vue',
                'image'=>'p.jpg',
                'user_id' => 1,
                'category_id'=>3
            ]
        );
    }
}
