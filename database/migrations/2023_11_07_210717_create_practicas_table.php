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
        Schema::create('practicas', function (Blueprint $table) {
            $table->id();
            $table->string('numeracion');
            $table->dateTime('fecha_sustentacion')->nullable();
            $table->string('etapa', 50)->default('Inicio');
            $table->string('estado', 50)->default('neutro');
            $table->string('path_informe_final', 2048)->nullable();
            $table->string('path_acta_revison', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicas');
    }
};
