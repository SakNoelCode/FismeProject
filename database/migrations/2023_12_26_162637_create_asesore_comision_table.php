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
        Schema::create('asesore_comision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asesore_id')->constrained('asesores')->onDelete('cascade');
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->string('cargo', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesore_comision');
    }
};
