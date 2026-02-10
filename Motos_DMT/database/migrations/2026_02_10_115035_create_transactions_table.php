<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // 1. Relación 1:N con el Usuario (quién compra)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 2. Relación con la Moto (qué compra) 
            // Nota: Asegúrate de que la migración de 'motos' se ejecute antes
            $table->foreignId('moto_id')->constrained('motos');

            // 3. Campos requeridos para la Pasarela de Pagos (PayPal)
            $table->string('paypal_order_id')->unique(); // ID de transacción
            $table->string('status');                     // 'COMPLETED', 'PENDING', etc.
            $table->decimal('amount', 10, 2);            // Precio (ej: 200.00)
            $table->string('currency')->default('EUR');  // Moneda

            // 4. Marca de tiempo (Requisito: Fecha del pago)
            $table->timestamps();
        });
    }
};
