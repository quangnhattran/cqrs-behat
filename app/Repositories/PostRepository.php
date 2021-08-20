<?php

namespace App\Repositories;

use App\Models\Post;
use App\Contracts\Post as PostContract;

class PostRepository extends BaseRepository implements PostContract
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return Post::class;
    }
}
