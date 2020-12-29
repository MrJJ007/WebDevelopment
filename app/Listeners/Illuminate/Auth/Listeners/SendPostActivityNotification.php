<?php

namespace App\Listeners\Illuminate\Auth\Listeners;

use App\Events\NewMessage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;

class SendPostActivityNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->this;
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(NewMessage $event)
    {
        dd($event->user);
    }
    public function failed(NewMessage $event, $exception)
    {
        dd($event->user,$exception);
    }
}
