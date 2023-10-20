<?php

namespace App\Listeners;

use App\Events\FormationValidated;
use App\Models\Formation;
use App\Models\Question;
use App\Services\AttestationService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class FormationValidatedListener
{
    protected AttestationService $attestationService;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->attestationService = new AttestationService;
    }

    /**
     * Handle the event.
     */
    public function handle(FormationValidated $event): void
    {

        $questionId = $event->listQuizz[0]["question_id"];
        $question = Question::where('id', $questionId)->first();
        $formation = Formation::where('id', $question->formation_id)->first();

        $availableHour =  Carbon::createFromFormat('H:i:s', $event->user->available_hour);
        $totalDuration =  Carbon::createFromFormat('H:i:s', $formation->duration);

        if ($availableHour->lessThanOrEqualTo($totalDuration)) {
            $availableHour = null; // Si l'heure est inférieure ou égale à la durée, définissez-la sur null
            $this->attestationService->deliverAttestation($event->user);
        } else {
            // Sinon, soustrayez la durée de la formation de l'heure disponible
            $availableHour =  $availableHour->subHours($totalDuration->hour)
                ->subMinutes($totalDuration->minute)
                ->subSeconds($totalDuration->second);
        }

        $event->user->available_hour = $availableHour;
        $event->user->save();
    }
}
