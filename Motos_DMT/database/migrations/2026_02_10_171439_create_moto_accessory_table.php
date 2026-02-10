<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moto_accessory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moto_id')->constrained()->onDelete('cascade');
            $table->foreignId('accessory_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Evitar duplicados
            $table->unique(['moto_id', 'accessory_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moto_accessory');
    }
};