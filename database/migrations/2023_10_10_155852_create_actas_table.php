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
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->dateTime('fecha');
            $table->string('estado');
            $table->text('observaciones',1000);
            $table->text('archivo');   
            $table->unsignedBigInteger('practicante_id');
            $table->foreign('practicante_id')->references('id')->on('practicantes')->onDelete('cascade');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
