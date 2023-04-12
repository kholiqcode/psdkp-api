<?php

namespace App\Listeners;

use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail
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
    public function handle(object $event): void
    {
        if ($event->user->email_verified_at) {
            return;
        }

        Mail::to($event->user->email)->send(new ActivationEmail($event->user));
    }
}
