<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailTestController extends Controller
{
    public function sendTestEmail()
    {
        $toEmail = 'recipient@example.com'; // Cambia esto por un correo real
        $data = [
            'subject' => 'Prueba de correo',
            'body' => 'Este es un correo de prueba enviado desde Laravel.',
        ];

        Mail::raw($data['body'], function ($message) use ($toEmail, $data) {
            $message->to($toEmail)
                    ->subject($data['subject']);
        });

        return response()->json(['message' => 'Correo enviado exitosamente.']);
    }
}
