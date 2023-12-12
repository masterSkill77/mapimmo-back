<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SendMailService;
use Exception;

class ContactController extends Controller
{
    public function __construct(protected SendMailService $sendMailService)
    {
    }
    public function __invoke(Request $request)
    {
        $email = $request->input('email');
        $fullname = $request->input('fullname');
        $subject = $request->input('subject');
        $phoneNumber = $request->input('phoneNumber');
        $message = $request->input('message');
        try {
            $this->sendMailService->sendMail($fullname, $email, $phoneNumber, $subject, $message);
            return response()->json(['success' => 'Mail sent']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
