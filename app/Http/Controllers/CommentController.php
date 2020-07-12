<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'comment' => $request->comment,
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('articles.show', $request->article_id);
    }

    public function destroy(Comment $comment)
    {
        if (!auth()->user()->can('delete', $comment)) {
            abort(403);
        }

        Comment::find($comment->id)->delete();

        return redirect()->route('articles.show', $comment->article_id);
    }
}
