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
            $table->string('documento_path', 2048);
            $table->string('cargo_path',2048)->nullable();
            $table->string('pase_proveido',200)->nullable();
            $table->string('para_proveido',200)->nullable();
            $table->date('fecha_proveido')->nullable();
            $table->foreignId('tipoacta_id')->constrained('tipoactas')->onDelete('cascade');
            $table->foreignId('practica_id')->constrained('practicas')->onDelete('cascade');
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
