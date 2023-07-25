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
        Schema::create('etapa1', function (Blueprint $table) {
            $table->id();
            $table->string('solicitud_path',255)->nullable();
            $table->string('asesoramiento_path',255)->nullable();
            $table->string('comentarios',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapa1');
    }
};
