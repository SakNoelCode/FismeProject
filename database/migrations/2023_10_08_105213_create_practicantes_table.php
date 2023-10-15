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
        Schema::create('practicantes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('tramite');
            $table->string('dirigido');
            $table->string('codigo');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('facultad');
            $table->string('escuela');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->unsignedBigInteger('docente_id');
            $table->string('docente');
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            $table->string('fundamentacion');
            $table->string('archivo');
            $table->integer('folios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicantes');
    }
};
