<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $tipo;

    public function __construct($data, $tipo)
    {
        $this->data = $data;
        $this->tipo = $tipo; // 'reserva' o 'alquiler'
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CONFIRMACIÓN DE RUTA - MOTOS DMT',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-received',
        );
    }
}