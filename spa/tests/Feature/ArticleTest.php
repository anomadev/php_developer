<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Article;
use App\Comment;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->article = factory(Article::class)->create();
        $this->actingAs($this->user);
    }

    /**
     *
     * @test
     */

    public function itShowsACollectionOfArticles()
    {
        $this->json('GET', "/api/articles?api_token={$this->user->api_token}")
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $this->article->id,

                        'attributes' => [
                            'title' => $this->article->title,
                            'description' => $this->article->content,
                            'picture' => $this->article->thumbnail,
                            'created_at' => $this->article->created_at->diffForHumans()
                        ]
                    ]
                ]
            ]);
    }

    /**
     *
     * @test
     */

    public function itShowsAnArticle()
    {
        $this->json('GET', "/api/articles/{$this->article->slug}?api_token={$this->user->api_token}")
            ->assertStatus(200)
            ->assertJson([
                'id' => $this->article->id,

                'attributes' => [
                    'title' => $this->article->title,
                    'description' => $this->article->content,
                    'picture' => $this->article->thumbnail,
                    'created_at' => $this->article->created_at->diffForHumans()
                ]
            ]);
    }

    /**
     *
     * @test
     */

    public function itCreatesASingleArticle()
    {
        $this->assertEquals(1, Article::count());
        $data = [
            'title' => 'lorem insu dolor',
            'content' => 'Lorem ipsum is simply dummy text of the printing and',
            'thumbnail' => 'https://picsum.photos/250/500',
            'api_token' => $this->user->api_token
        ];

        $this->json('POST', '/api/articles', $data)
            ->assertStatus(201);
        $this->assertEquals(2, Article::count());
    }

    /**
     *
     * @test
     */

    public function itDeletesAnArticle()
    {
        $this->json('DELETE', "/api/articles/{$this->article->slug}", ['api_token' => $this->user->api_token])
            ->assertStatus(204);
        $this->assertNull(Article::find($this->article->id));
    }

    /**
     *
     * @test
     */

    public function theOwnerCanDeleteTheArticleFails()
    {
        $user = factory(User::class)->create();
        $this->json('DELETE', "/api/articles/{$this->article->slug}", ['api_token' => $user->api_token])
            ->assertStatus(403);
    }
}
