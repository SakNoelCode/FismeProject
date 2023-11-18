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
        Schema::create('proveidos', function (Blueprint $table) {
            $table->id();
            $table->string('pase',30);
            $table->string('para',30);
            $table->dateTime('fecha');
            $table->foreignId('expediente_id')->constrained('expedientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveidos');
    }
};
