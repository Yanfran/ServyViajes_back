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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->mediumText('descripcion');
            $table->mediumText('politicas');
            $table->unsignedBigInteger('id_servicios'); // Columna de clave foránea
            $table->foreign('id_servicios')->references('id')->on('services_of_hotels'); // Definición de la clave foránea
            $table->unsignedBigInteger('id_gallery'); // Columna de clave foránea
            $table->foreign('id_gallery')->references('id')->on('gallery'); // Definición de la clave foránea
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
