<?php

namespace App\Listeners;

use App\Events\ChangeOrderStatus;
use App\Mail\ChangeOrderStatus as ChangeOrderStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ChangeOrderStatusNotification
{
    /**
     *
     * Handle the event.
     */
    public function handle(ChangeOrderStatus $event): void
    {
        Mail::to($event->order->client->email)->send(new ChangeOrderStatusMail($event->order));
    }
}
