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
            $table->string('tipo',50);
            $table->string('estado',50)->default('por definir');
            $table->string('asunto',250);
            $table->string('tipo_documento',20);
            //$table->foreignId('remitente_id')->constrained('remitentes')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->unsignedBigInteger('expedientable_id');
            $table->string('expedientable_type');
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
