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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('numeracion',45);
            $table->string('codigo',8);
            $table->date('fecha_recepcion');
            $table->string('estado',50)->default('pendiente');
            $table->foreignId('remitente_id')->constrained('remitentes')->onDelete('cascade');
            $table->foreignId('documento_id')->unique()->constrained('documentos')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
