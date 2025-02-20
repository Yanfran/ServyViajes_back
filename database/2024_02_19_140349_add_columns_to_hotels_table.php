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
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('beneficiario')->nullable();
            $table->string('banco')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('clabe_interbancaria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('beneficiario');
            $table->dropColumn('banco');
            $table->dropColumn('numero_cuenta');
            $table->dropColumn('clabe_interbancaria');
        });
    }
};
