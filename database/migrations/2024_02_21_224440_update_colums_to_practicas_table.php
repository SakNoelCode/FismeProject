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
            $table->foreignId('presidente_id')->after('path_acta_revison')->nullable()->constrained('asesores')->cascadeOnDelete();
            $table->foreignId('secretario_id')->after('path_acta_revison')->nullable()->constrained('asesores')->cascadeOnDelete();
            $table->foreignId('vocal_id')->after('path_acta_revison')->nullable()->constrained('asesores')->cascadeOnDelete();
            $table->foreignId('accesitario_id')->after('path_acta_revison')->nullable()->constrained('asesores')->cascadeOnDelete();
           // $table->string('path_designacion_jurado')->after('path_acta_revison')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practicas', function (Blueprint $table) {
            $table->dropForeign(['presidente_id']);
            $table->dropForeign(['secretario_id']);
            $table->dropForeign(['vocal_id']);
            $table->dropForeign(['accesitario_id']);
            $table->dropColumn(['presidente_id', 'secretario_id', 'vocal_id', 'accesitario_id']);
        });
    }
};
