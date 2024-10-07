<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psy\Readline\Hoa\Console;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase; 

    protected function setUp(): void
    {
        parent::setUp();
   
    }

    /** @test */
    public function a_user_can_add_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        $response = $this->post(route('comments.store', $post->id), [
            'body' => 'This is a comment.',
        ]);
       
        $this->assertDatabaseHas('comments', [
            'body' => 'This is a comment.',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response->assertRedirect(route('posts.show', $post->id));
        $response->assertSessionHas('success', 'Comment added successfully!');
    }

    /** @test */
    public function a_user_can_delete_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        $comment = Comment::factory()->create([
            'body' => 'This is a comment.',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->delete(route('comments.destroy', $comment->id));

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Comment deleted successfully!');
    }

    /** @test */
    public function a_comment_requires_a_body()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        $response = $this->post(route('comments.store', $post->id), [
            'body' => '',
        ]);

        $response->assertSessionHasErrors('body');
    }
}