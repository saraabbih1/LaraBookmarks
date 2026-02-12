<?php

namespace App\Listeners;

use App\Events\LinkActionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use app\Models\ActivityLog;

class LogLinkAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LinkActionEvent $event): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $event->action,
            'model' => 'Link',
            'model_id' => $event->link->id,
        ]);
    }
}
