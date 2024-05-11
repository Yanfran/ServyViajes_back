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
        Schema::table('rooms_by_hotels', function (Blueprint $table) {                                                
            $table->string('tipo_habitacion')->nullable()->change();
            $table->float('precio_adulto', $precision = 8, $scale = 2)->nullable()->change();
            $table->float('sencilla', $precision = 8, $scale = 2)->nullable()->change();
            $table->float('doble', $precision = 8, $scale = 2)->nullable()->change();
            $table->float('triple', $precision = 8, $scale = 2)->nullable()->change();
            $table->float('cuadruple', $precision = 8, $scale = 2)->nullable()->change();
            $table->integer('edad_minima')->nullable()->change();
            $table->integer('edad_maxima')->nullable()->change();
            $table->float('precio_menores', $precision = 8, $scale = 2)->nullable()->change();
            $table->integer('habitaciones_disponibles')->nullable()->change();            
            $table->date('vigencia')->nullable()->change();        

            $table->integer('infante_edad_minima')->nullable();
            $table->integer('infante_edad_maxima')->nullable();
            $table->float('infante_precio_menores', $precision = 8, $scale = 2)->nullable();                              
            $table->integer('aplica')->nullable();                              
            $table->integer('junior_edad_minima')->nullable();
            $table->integer('junior_edad_maxima')->nullable();
            $table->float('junior_precio_menores', $precision = 8, $scale = 2)->nullable();                              
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
