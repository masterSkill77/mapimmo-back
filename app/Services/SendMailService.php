<?php

namespace App\Services;

use App\Mail\ContactMail;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class SendMailService
{
    public function __construct()
    {
    }
    public function sendMail(string $fullname, string $email, string $phoneNumber, string $subject, string $message): SentMessage | null
    {
        return Mail::to('clairmont.rajaonarison@gmail.com')->send(new ContactMail($fullname, $email, $phoneNumber, $subject, $message));
    }
}
