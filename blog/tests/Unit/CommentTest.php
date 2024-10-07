<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_comment_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $post = Post::factory()->create([
            'user_id'=> $user->id
        ]);
        $response = $this->post(route('comments.store', $post->id), [
            'body' => 'This is a test comment.',
        ]);
        $this->assertDatabaseHas('comments', [
            'body' => 'This is a test comment.',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $response->assertRedirect(route('posts.show', $post->id));
        $response->assertSessionHas('success', 'Comment added successfully!');
    }

    /** @test */
    public function it_requires_a_body_to_create_a_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $post = Post::factory()->create([
            'user_id'=> $user->id
        ]);
        $response = $this->post(route('comments.store', $post->id), [
            'body' => '',
        ]);

        $response->assertSessionHasErrors('body');
    }
}
