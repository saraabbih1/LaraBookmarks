<?php

namespace App\Providers;
use App\Events\LinkActionEvent;
use App\Listeners\LogLinkAction;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
     protected $listen = [
        LinkActionEvent::class => [
            LogLinkAction::class,
        ],
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
