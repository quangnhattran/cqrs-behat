<?php

namespace App\Http\Controllers;

use App\Http\Commands\Handlers\Posts\CreateCommand;
use App\Http\DataTransferObjects\PostData;
use App\Http\Repositories\PostRepository;
use App\Http\Requests\PostCreateRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->all();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.index', compact('post'));
    }

    public function store(PostCreateRequest $request, CreateCommand $command)
    {
        try {
            DB::beginTransaction();

            $postData = PostData::fromRequest($request->all());
            $command->run($postData);

            DB::commit();
            return response()->json();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }

    public function destroy()
    {

    }
}
