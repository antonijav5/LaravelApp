<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_all_posts()
    {
        $posts = Post::factory()->count(3)->create();
        $response = $this->get('/posts');
        $response->assertStatus(200);
        $response->assertSee($posts->first()->title);
    }

    public function test_can_view_single_post()
    {
        $post = Post::factory()->create();
        $response = $this->get("/posts/{$post->id}");
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/posts', [
            'title' => 'Test Post',
            'content' => 'This is the content of the post.'
        ]);

        $response->assertRedirect('/posts');
        $response->assertSessionHas('success', 'Post was successfully created!');
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    public function test_can_update_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Title',
            'content' => 'Updated content.'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Post updated successfully.']);
        $this->assertDatabaseHas('posts', ['title' => 'Updated Title']);
    }

    public function test_can_delete_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete("/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Post deleted successfully.']);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
