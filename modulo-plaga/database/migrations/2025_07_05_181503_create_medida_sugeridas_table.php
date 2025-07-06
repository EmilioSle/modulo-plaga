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
        Schema::create('medidas_sugeridas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plaga_id')->constrained('plagas')->onDelete('cascade');
            $table->text('accion'); // texto generado por la IA
            $table->string('fuente')->nullable(); // "OpenAI", "experto", etc.
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medida_sugeridas');
    }
};
