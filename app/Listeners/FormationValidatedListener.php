<?php

namespace App\Listeners;

use App\Events\FormationValidated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class FormationValidatedListener
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
    public function handle(FormationValidated $event): void
    {
        Log::info(json_encode($event->listQuizz));
    }
}
