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
            $table->string('codigo_estudiante',15);
            $table->string('telefono',20);
            $table->foreignId('escuela_id')->constrained('escuelas')->onDelete('cascade');
            $table->foreignId('asesore_id')->constrained('asesores')->onDelete('cascade');
            $table->foreignId('practica_id')->unique()->constrained('practicas')->onDelete('cascade');
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
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
