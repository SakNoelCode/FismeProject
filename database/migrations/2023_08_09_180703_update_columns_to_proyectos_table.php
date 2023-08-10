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
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
        Schema::table('proyectos', function (Blueprint $table) {
            $table->tinyInteger('estado')->default(0)->after('fecha_fin');
        });
        Schema::table('proyectos', function (Blueprint $table) {
            $table->foreignId('etapa_id')->after('empresa_id')->default(1)->constrained('etapas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
        Schema::table('proyectos', function (Blueprint $table) {
            $table->string('estado', 20)->after('fecha_fin')->default('inicio');
        });
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropForeign(['etapa_id']);
        });
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('etapa_id');
        });
    }
};
