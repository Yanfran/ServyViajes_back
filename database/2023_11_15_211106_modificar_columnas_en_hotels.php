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
            // Modificar la columna id_servicios para permitir valores nulos
            $table->unsignedBigInteger('id_servicios')->nullable()->change();

            // Modificar la columna id_gallery para permitir valores nulos
            $table->unsignedBigInteger('id_gallery')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
