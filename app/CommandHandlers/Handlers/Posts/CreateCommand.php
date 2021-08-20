<?php

namespace App\CommandHandlers\Handlers\Posts;

use App\Contracts\Command;
use App\Events\PostCreated;
use App\Http\DataTransferObjects\PostData;
use App\Repositories\PostRepository;

class CreateCommand implements Command
{
    protected PostRepository $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param PostData $postData
     * @return void
     */
    public function execute($postData)
    {
        $newPost = $this->postRepository->create([
            'user_id' => $postData->userId,
            'title' => $postData->title,
            'body' => $postData->body
        ]);

        event(new PostCreated($newPost));
    }
}
