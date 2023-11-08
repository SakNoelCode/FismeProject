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
        Schema::table('asesores', function (Blueprint $table) {
            $table->foreignId('comision_id')->nullable()->after('user_id')->constrained('comisiones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asesores', function (Blueprint $table) {
            $table->dropForeign(['comision_id']);
            $table->dropColumn('comision_id');
        });
    }
};
