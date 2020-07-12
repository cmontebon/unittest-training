<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Article;
use App\Comment;
use App\User;

class DeleteCommentTest extends TestCase
{
    /** @test */
    public function a_user_can_delete_a_comment()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $article = create(Article::class, [
            'user_id' => auth()->user()->id
        ]);

        $comment = create(Comment::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id,
            'comment' => 'Comment text here',
        ]);

        $this->delete("/comments/{$comment->id}");

        $this->assertDeleted('comments', $comment->toArray());
    }

    /** @test */
    public function a_user_can_only_delete_his_comment()
    {
        $user1 = create(User::class);
        $user2 = create(User::class);

        // sign in as user 1
        $this->be($user1);

        $article = create(Article::class, [
            'user_id' => auth()->user()->id
        ]);

        $comment = create(Comment::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id,
            'comment' => 'Comment text here',
        ]);

        // sign in as user 2
        $this->be($user2);

        $this->delete("/comments/{$comment->id}")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
