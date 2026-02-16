<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class VerifyEmailNotification extends VerifyEmail
{
    public function toMail($notifiable)
    {
        // Generamos la URL de verificación oficial de Laravel
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('BIENVENIDO AL CLUB - VERIFICA TU CUENTA')
            ->view('emails.verify-email', [
                'url' => $verificationUrl,
                'nombre' => $notifiable->name
            ]);
    }
}