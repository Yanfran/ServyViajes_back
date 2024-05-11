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
        Schema::table('landing_eventos', function (Blueprint $table) {
            $table->string('dias')->nullable();
            $table->string('conferencias')->nullable();
            $table->string('profesores')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_eventos', function (Blueprint $table) {
            $table->dropColumn('dias');
            $table->dropColumn('conferencias');
            $table->dropColumn('profesores');
        });
    }
};
