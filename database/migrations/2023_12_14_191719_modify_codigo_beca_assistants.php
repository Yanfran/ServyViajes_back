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
        Schema::table('assistants', function (Blueprint $table) {            
            $table->string('codigo_beca')->nullable()->change();
            $table->string('grado_academico')->nullable()->change();
            $table->string('nombre')->nullable()->change();
            $table->string('apellido_paterno')->nullable()->change();
            $table->string('apellido_materno')->nullable()->change();
            $table->string('correo_electronico')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->string('ciudad')->nullable()->change();
            $table->string('especialidad')->nullable()->change();
            $table->string('institucion')->nullable()->change();            
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
