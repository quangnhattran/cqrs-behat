<?php

namespace App\Http\DataTransferObjects;

use App\Http\Requests\PostCreateRequest;

class PostData
{
    /**
     * @var int
     */
    public int $userId;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $body;

    /**
     * @param array $request
     * @return PostData
     */
    public static function fromRequest(array $request): PostData
    {
        $dto = new self();

        $dto->title = $request['title'];
        $dto->body = $request['body'];
        $dto->userId = $request['user_id'];

        return $dto;
    }
}
