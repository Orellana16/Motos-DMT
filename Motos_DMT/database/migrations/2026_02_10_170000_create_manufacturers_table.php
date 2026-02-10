<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('pais')->nullable();
            $table->string('logo')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('website')->nullable();
            $table->integer('año_fundacion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manufacturers');
    }
};