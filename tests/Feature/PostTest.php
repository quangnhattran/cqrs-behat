<?php

namespace Tests\Feature;

use App\Notifications\NewPostNotification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function test_unauthorized_user_cannot_make_new_post()
    {
        $response = $this->postJson('/api/posts', []);
        $response->assertUnauthorized();
    }

    public function test_authorized_user_can_make_new_post()
    {
        Notification::fake();
        Notification::assertNothingSent();

        $postData = factory(Post::class)->make()->toArray();

        $response = $this->actingAs($this->user)->postJson('/api/posts', $postData);

        $response->assertOk();
        $this->assertDatabaseCount('posts', 1);
        Notification::assertSentTo($this->user, NewPostNotification::class);
    }
}
