<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_a_post()
    {
        $user = User::factory()->make();
        Auth::shouldReceive('user')->andReturn($user);
        $request = Request::create('/posts', 'POST', [
            'title' => 'Test Post',
            'content' => 'This is a test post content.'
        ]);

        $controller = new PostController();
        $response = $controller->store($request);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post content.'
        ]);
        $this->assertEquals(302, $response->getStatusCode()); 
        $this->assertEquals(session('success'), 'Post was successfully created!');
    }
}
