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
        Schema::table('practicas', function (Blueprint $table) {
            $table->dateTime('fecha_sustentacion_final')->nullable()->after('fecha_sustentacion');
            $table->string('path_acta_sustentacion')->nullable()->after('path_acta_revison');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practicas', function (Blueprint $table) {
            $table->dropColumn(['fecha_sustentacion_final','path_acta_sustentacion']);
        });
    }
};
