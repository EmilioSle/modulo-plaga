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
        Schema::create('lotes_afectados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plaga_id')->constrained('plagas')->onDelete('cascade');
            $table->string('ubicacion');
            $table->string('cultivo');
            $table->integer('severidad'); // 1–10
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lote_afectados');
    }
};
