<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Models\Link;
use app\Policies\LinkPolicy;
class AppServiceProvider extends ServiceProvider
{
    protected $policies=[Link::class=>LinkPolicy::class,];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
