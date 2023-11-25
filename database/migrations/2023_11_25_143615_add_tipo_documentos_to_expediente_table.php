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
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropColumn('tipo_documento');
            $table->foreignId('tipodocumento_id')->after('expedientable_type')->constrained('tipodocumentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->string('tipo_documento',20);
        });

        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign(['tipodocumento_id']);
            $table->dropColumn('tipodocumento_id');
        });
    }
};
