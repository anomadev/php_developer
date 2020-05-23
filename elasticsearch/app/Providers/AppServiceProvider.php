<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\ElasticsearchRepository;
use App\Observers\ElasticsearchObserver;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function($app) {
            return ClientBuilder::create()->setHosts([env('SEARCH_HOST')])->build();
        });

        $this->app->bind(ElasticsearchRepository::class, function($app) {
            return new ElasticsearchRepository($app->make(Client::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ElasticsearchObserver::class);
    }
}
