<?php

namespace App\Providers;

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
        $this->app->bind(Pdf::class, function () {
            return new Pdf(base_path() . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386');
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
