<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        //
        $comments = $task->comments()->with('user')->latest()->get();

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Task $task)
    {
        //
        $comment = $task->comments()->create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return new CommentResource(($comment->load('user')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $comment->delete($comment);

        return response()->noContent();
    }
}
