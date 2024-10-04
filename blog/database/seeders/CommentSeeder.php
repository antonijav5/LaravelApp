<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Comment::factory()->count(120)->create(); // Kreira 120 lažnih komentara
    }
}
