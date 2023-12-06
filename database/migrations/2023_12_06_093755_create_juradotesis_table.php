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
        Schema::create('juradotesis', function (Blueprint $table) {
            $table->id();
            $table->string('presidente',250);
            $table->string('secretario',250);
            $table->string('vocal',250);
            $table->string('accesitario',250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juradotesis');
    }
};
