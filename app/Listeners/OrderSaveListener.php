<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\SendOrderMail;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class OrderSaveListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = Order::where('id',$event->order->id)->with('user')->first();

        $user = User::where('id', $order->user_id)->first();

        // On crée des variables hour et les additionner pour le nouveau availableHour de l'utilisateur
        $availableHour =  isset($user->available_hour) ? Carbon::createFromFormat('H:i:s', $user->available_hour) : Carbon::createFromFormat('H:i:s', '00:00:00');
        $hourRemains =  $user->hour_remains ? Carbon::createFromFormat('H:i:s', $user->hour_remains) : Carbon::createFromFormat('H:i:s', '00:00:00');
        $totalDuration =  Carbon::createFromFormat('H:i:s', $order->total_duration);
        $availableHour->addHours($totalDuration->hour)->addMinutes($totalDuration->minute)->addSeconds($totalDuration->second);

        $user->available_hour = $availableHour->format('H:i:s');

        $resultatRemains = $hourRemains->addHours($totalDuration->hour)->addMinutes($totalDuration->minute)->addSeconds($totalDuration->second);
        $user->hour_remains = $resultatRemains->format('H:i:s');

        $user->save();
        $dompdf = new Dompdf();
        $html = view('invoice', ["orders" => $order])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $pdfContent = $dompdf->output();

        $email = $user['email'];
        $subject = 'Facture pour la commande';
        $attachment = [
            'data' => $pdfContent,
            'filename' => 'Facture-' . now() . ".pdf"
        ];
        Mail::to($email)->send(new SendOrderMail($subject, $attachment, $order));
    }
}
