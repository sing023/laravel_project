<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment();
        $comment->comment = '1st Comment';
        $comment->user_id =1;
        $comment->post_id =1;
        $comment->save();

        $comment = new Comment();
        $comment->comment = '2nd Comment';
        $comment->user_id = 2;
        $comment->post_id =1;
        $comment->save();

        $comment->Comment::factory()->count(10)->create();
    }
}
