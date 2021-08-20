<?php

namespace App\Http\Controllers\Post;

use App\CommandHandlers\Handlers\Posts\CreateCommand;
use App\Facades\CommandFactory;
use App\Http\DataTransferObjects\PostData;
use App\Repositories\PostRepository;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->getAll();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.index', compact('post'));
    }

    public function store(PostCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $requestData = array_merge($request->validated(), ['user_id' => auth()->id()]);
            $postData = PostData::fromRequest($requestData);
            CommandFactory::handle(CreateCommand::class, $postData);

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
