<?php

namespace Tests\Unit;

use App\CommandHandlers\Handlers\Posts\CreateCommand;
use App\Http\DataTransferObjects\PostData;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class CreatePostCommandTest extends TestCase
{
    protected User $user;
    protected CreateCommand $createCommand;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createCommand = app(CreateCommand::class);
        $this->user = factory(User::class)->create();
    }

    public function test_command_create_post()
    {
        $requestData = ['user_id' => $this->user->id] + factory(Post::class)->make()->toArray();
        $postDTO = PostData::fromRequest($requestData);

        $this->createCommand->execute($postDTO);

        $this->assertDatabaseHas('posts', $requestData);
    }
}
