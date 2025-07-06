<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deteccions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('imagen')->nullable(); // ruta de imagen capturada
            $table->string('resultado_ia')->nullable(); // nombre de plaga detectada
            $table->foreignId('plaga_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('lote_afectado_id')->constrained('lotes_afectados')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deteccions');
    }
};
