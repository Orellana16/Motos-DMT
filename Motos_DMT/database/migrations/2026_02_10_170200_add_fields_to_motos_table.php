<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('motos', function (Blueprint $table) {
            $table->foreignId('manufacturer_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->after('manufacturer_id')->constrained()->onDelete('cascade');
            $table->string('imagen')->nullable()->after('modelo');
            $table->text('descripcion')->nullable()->after('imagen');
            $table->integer('año')->after('descripcion');
            $table->integer('cilindrada')->after('año')->comment('En CC');
            $table->integer('stock')->default(0)->after('precio');
            $table->boolean('disponible')->default(true)->after('stock');
        });
    }

    public function down(): void
    {
        Schema::table('motos', function (Blueprint $table) {
            $table->dropForeign(['manufacturer_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'manufacturer_id',
                'category_id',
                'imagen',
                'descripcion',
                'año',
                'cilindrada',
                'stock',
                'disponible'
            ]);
        });
    }
};