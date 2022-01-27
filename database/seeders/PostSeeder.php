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
                'title' =>'a simple title',
                'slug' =>Str::slug('a simple title'),
                'body' =>'a simple title',
                'image'=>'p.jpg',
                'user_id' => 1,
            ]
        );
        \App\Models\Post::create(
            [
                'title' =>'a simple title',
                'slug' =>Str::slug('a simple title'),
                'body' =>'a simple title',
                'image'=>'p.jpg',
                'user_id' => 1,
            ]
        );
        \App\Models\Post::create(
            [
                'title' =>'a simple title',
                'slug' =>Str::slug('a simple title'),
                'body' =>'a simple title',
                'image'=>'p.jpg',
                'user_id' => 1,
            ]
        );
    }
}
