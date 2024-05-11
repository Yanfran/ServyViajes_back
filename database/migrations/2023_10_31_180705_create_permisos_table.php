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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rol'); // Columna de clave foránea
            $table->foreign('id_rol')->references('id')->on('roles'); // Definición de la clave foránea
            $table->unsignedBigInteger('id_permisologia'); // Columna de clave foránea
            $table->foreign('id_permisologia')->references('id')->on('permisologia'); // Definición de la clave foránea                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
