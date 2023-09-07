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
        Schema::create('historiales', function (Blueprint $table) {
            $table->id();
            $table->string('documento_adjunto',100)->nullable();
            $table->dateTime('fecha_hora');
            $table->string('descripcion',255);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('expediente_id')->constrained('expedientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiales');
    }
};
