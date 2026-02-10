<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('moto_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Evitar que un usuario marque la misma moto como favorita múltiples veces
            $table->unique(['user_id', 'moto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};