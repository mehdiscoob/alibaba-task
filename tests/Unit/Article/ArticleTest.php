<?php

namespace Article;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use Modules\Article\App\Models\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /** @test */
    public function it_creates_an_article()
    {
        $user = User::factory()->count(1)->create()[0]->generate_token();
        $article = Article::factory()->count(1)->make()[0];
        $response = $this->postJson('/api/article', [
            'title' => $article->title,
            'content' => $article->content,
            'publication_date' => $article->publication_date,
            'publication_status' => $article->publication_status,
        ], ["Authorization" => "Bearer " . $user->access_token]);

        $response->assertStatus(201); // Assuming you return HTTP status 201 for successful order creation
        $this->assertDatabaseHas('articles', ['title' => $article->title]); // Assuming 'orders' is your orders table
    }

    /** @test */
    public function it_updates_an_article()
    {
        $user = User::factory()->count(1)->create()[0]->generate_token();
        $roleId = rand(1, 3);
        $user->roles()->attach($roleId);
        $article = Article::factory()->count(1)->create(function ($q) use ($user, $roleId) {
            if ($roleId == 3) {
                return ["user_id" => $user->id];
            } else {
                return [];
            }
        })[0];
        $data = Article::factory()->count(1)->make()[0];
        $response = $this->patchJson('/api/article/' . $article->id, [
            'title' => $data->title,
            'content' => $data->content,
            'publication_date' => $data->publication_date,
            'publication_status' => $data->publication_status,
        ], ["Authorization" => "Bearer " . $user->access_token]);

        $response->assertStatus(200); // Assuming you return HTTP status 201 for successful order creation
        $this->assertDatabaseHas('articles', ['title' => $data->title]); // Assuming 'orders' is your orders table
    }

    /** @test */
    public function it_find_an_article_by_id()
    {
        $article = Article::factory()->create();
        $user = $article->user()->first()->generate_token();
        $user->roles()->attach(3);
        $response = $this->getJson('/api/article/' . $article->id, ["Authorization" => "Bearer " . $user->access_token]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', ['title' => $article->title]);
    }

    /** @test */
    public function it_articles_paginate()
    {
        $user = User::factory()->create()->generate_token();
        $user->roles()->attach(2);
        Article::factory()->count(500)->create();
        $response = $this->getJson('/api/article', ["Authorization" => "Bearer " . $user->access_token]);
        $response->assertStatus(200);
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
