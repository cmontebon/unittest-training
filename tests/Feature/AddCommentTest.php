<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Article;
use App\Comment;

class AddCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function a_user_can_comment_to_an_article()
    {
        $article = create(Article::class, [
            'user_id' => auth()->user()->id
        ]);

        $comment = raw(Comment::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id
        ]);

        $this->post('/comments', $comment)
            ->assertRedirect("/articles/{$article->id}");

        $this->assertDatabaseHas('comments', [
            'user_id' => auth()->user()->id,
            'article_id' => $comment['article_id'],
            'comment' => $comment['comment']
        ]);
    }
}
