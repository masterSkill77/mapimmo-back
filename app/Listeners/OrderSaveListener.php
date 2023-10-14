<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\SendOrderMail;
use App\Models\Order;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        $order = Order::find($event->order->id)->with('user')->first();

        $user = $order->user;
        // On crée des variables hour et les additionner pour le nouveau availableHour de l'utilisateur
        $availableHour =  Carbon::createFromFormat('H:i:s', $user->available_hour);
        $totalDuration =  Carbon::createFromFormat('H:i:s', $order->total_duration);

        $resultat = $availableHour->addHours($totalDuration->hour)->addMinutes($totalDuration->minute)->addSeconds($totalDuration->second);
        $user->available_hour = $resultat->format('H:i:s');
        $user->update();
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
