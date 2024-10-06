<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase; // Ovo će resetovati bazu podataka posle svakog testa

    protected function setUp(): void
    {
        parent::setUp();
        // Kreiraj korisnika i post za testiranje
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
    }

    /** @test */
    public function a_user_can_add_a_comment()
    {
        // Prijavi korisnika
        $this->actingAs($this->user);

        // Pošalji zahtev za dodavanje komentara
        $response = $this->post(route('comments.store', $this->post->id), [
            'body' => 'This is a comment.',
        ]);

        // Proveri da je komentar dodat
        $this->assertDatabaseHas('comments', [
            'body' => 'This is a comment.',
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        // Proveri redirekciju
        $response->assertRedirect(route('posts.show', $this->post->id));
        $response->assertSessionHas('success', 'Comment added successfully!');
    }

    /** @test */
    public function a_user_can_delete_a_comment()
    {
        // Prijavi korisnika
        $this->actingAs($this->user);

        // Kreiraj komentar
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        // Pošalji zahtev za brisanje komentara
        $response = $this->delete(route('comments.destroy', $comment->id));

        // Proveri da komentar više ne postoji
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);

        // Proveri redirekciju
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Comment deleted successfully!');
    }

    /** @test */
    public function a_comment_requires_a_body()
    {
        // Prijavi korisnika
        $this->actingAs($this->user);

        // Pokušaj dodati komentar bez tela
        $response = $this->post(route('comments.store', $this->post->id), [
            'body' => '',
        ]);

        // Proveri grešku
        $response->assertSessionHasErrors('body');
    }
}