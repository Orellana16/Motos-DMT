<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contactar');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'nombre'  => 'required|string|max:120',
            'email'   => 'required|email|max:120',
            'mensaje' => 'required|string|max:2000',
        ]);

        // Funciona aunque no tengas mail configurado: lo registramos en logs
        Log::info('Nuevo mensaje de contacto', $data);

        // Si el mail está configurado, intentamos enviar (si falla, no rompemos el flujo)
        try {
            $to = config('mail.from.address') ?: env('MAIL_FROM_ADDRESS');
            if ($to) {
                Mail::raw(
                    "Nombre: {$data['nombre']}\nEmail: {$data['email']}\n\nMensaje:\n{$data['mensaje']}",
                    function ($message) use ($to) {
                        $message->to($to)->subject('Contacto - Motos DMT');
                    }
                );
            }
        } catch (\Throwable $e) {
            Log::warning('Fallo envío mail contacto: '.$e->getMessage());
        }

        return redirect()->route('contactar')->with('success', 'Mensaje enviado. Te responderemos pronto.');
    }
}
