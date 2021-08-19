<?php

namespace App\Http\Repositories;

use App\Post;

class PostRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }
}
