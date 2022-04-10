<?php

namespace App\Providers;

use App\DataProvider\Database\RegisterReviewDataProvider;
use App\DataProvider\RegisterReviewProviderInterface;
use App\Foundation\ElasticsearchClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Knp\Snappy\Pdf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(Pdf::class, function () {
        //     return new Pdf(base_path() . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386');
        // });
        $this->app->bind(RegisterReviewProviderInterface::class, function () {
            return new RegisterReviewDataProvider();
        });
        $this->app->singleton(ElasticsearchClient::class, function (Application $app) {
            $hosts = config('elasticsearch.hosts');
            return new ElasticsearchClient($hosts);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
