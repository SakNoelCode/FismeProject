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
        Schema::create('remitentes', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social',100)->nullable();
            $table->string('tipo_documento',50)->nullable();
            $table->string('numero_documento',45)->nullable();
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remitentes');
    }
};
