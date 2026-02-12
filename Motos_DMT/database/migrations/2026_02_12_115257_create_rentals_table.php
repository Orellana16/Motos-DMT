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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('moto_id')->constrained()->onDelete('cascade');

            // Fechas del alquiler
            $table->date('start_date');
            $table->date('end_date');

            // Cálculos económicos
            $table->decimal('total_price', 10, 2); // (Precio Moto * 0.01) * días
            $table->string('status')->default('pending'); // pending, confirmed, finished

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
