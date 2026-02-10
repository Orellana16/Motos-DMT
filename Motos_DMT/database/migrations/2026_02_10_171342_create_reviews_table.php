<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('moto_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->default(5); // 1-5 estrellas
            $table->text('comentario')->nullable();
            $table->boolean('verificado')->default(false);
            $table->integer('utilidad')->default(0); // Votos de utilidad
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};