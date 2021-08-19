<?php

namespace Tests\Unit;

use App\Http\Commands\Handlers\Posts\CreateCommand;
use App\Http\DataTransferObjects\PostData;
use App\Post;
use App\User;
use Tests\TestCase;

class CreatePostCommandTest extends TestCase
{
    protected User $user;
    protected CreateCommand $createCommand;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createCommand = app(CreateCommand::class);
        $this->authenticateWithAUser();
    }

    public function test_command_create_post()
    {
        $requestData = factory(Post::class)->make()->toArray();
        $postDTO = PostData::fromRequest($requestData);

        $this->createCommand->run($postDTO);

        $this->assertDatabaseHas('posts', $requestData);
    }

    protected function authenticateWithAUser()
    {
        $this->be(factory(User::class)->create());
    }
}
