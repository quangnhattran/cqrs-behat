<?php

namespace App\Http\Commands\Handlers\Posts;

use App\Events\PostCreated;
use App\Http\Commands\Contracts\Command;
use App\Http\DataTransferObjects\PostData;

class CreateCommand implements Command
{
    /**
     * @param PostData $dto
     * @return void
     */
    public function run($dto): void
    {
        $newPost = auth()->user()->posts()->create((array) $dto);

        event(new PostCreated($newPost));
    }
}
