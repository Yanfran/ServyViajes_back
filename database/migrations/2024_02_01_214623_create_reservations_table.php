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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plan_types')->onDelete('cascade');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->integer('cantidad_noches');
            $table->string('nombre_solicitante')->nullable();
            $table->string('apellido_solicitante')->nullable();
            $table->string('correo_solicitante')->nullable();
            $table->string('telefono_solicitante')->nullable();
            $table->string('ciudad_solicitante')->nullable();
            $table->float('monto_total', $precision = 8, $scale = 2);
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
