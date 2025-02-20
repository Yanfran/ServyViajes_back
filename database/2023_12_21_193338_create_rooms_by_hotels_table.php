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
        Schema::create('rooms_by_hotels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plan_types')->onDelete('cascade');
            $table->string('tipo_habitacion');
            $table->float('precio_adulto', $precision = 8, $scale = 2);
            $table->float('sencilla', $precision = 8, $scale = 2);
            $table->float('doble', $precision = 8, $scale = 2);
            $table->float('triple', $precision = 8, $scale = 2);
            $table->float('cuadruple', $precision = 8, $scale = 2);
            $table->integer('edad_minima');
            $table->integer('edad_maxima');
            $table->float('precio_menores', $precision = 8, $scale = 2);
            $table->integer('habitaciones_disponibles');            
            $table->date('vigencia');
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_by_hotels');
    }
};
