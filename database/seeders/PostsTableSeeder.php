<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->title = '1st Title ';
        $post->description = 'This the description of the 1st post';
        $post->user_id = 1;
        $post->save();

        $post = new Post();
        $post->title = '2nd Title';
        $post->description = 'this is the description of the 2nd post';
        $post->user_id = 2;
        $post->save();

        $posts->factory()->count(10)->create();
    }
}
