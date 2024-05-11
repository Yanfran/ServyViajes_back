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
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_beca');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('grado_academico');
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->mediumText('comentario')->nullable();
            $table->unsignedBigInteger('pais_id');
            $table->foreign('pais_id')->references('id')->on('countrys')->onDelete('cascade');
            $table->string('estado');
            $table->string('ciudad');
            $table->string('especialidad');
            $table->string('institucion');
            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('facturacion');
            $table->string('rfc')->nullable();
            $table->string('nombre_fiscal')->nullable();
            $table->string('correo_facturacion')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->unsignedBigInteger('regimen_fiscal_id')->nullable();
            $table->foreign('regimen_fiscal_id')->references('id')->on('tax_regimes')->onDelete('cascade');
            $table->unsignedBigInteger('cfdi_id')->nullable();
            $table->foreign('cfdi_id')->references('id')->on('cfdi')->onDelete('cascade');            
            $table->mediumText('comentario_facturacion')->nullable();
            $table->integer('estatus');
            $table->float('monto_total', $precision = 8, $scale = 2)->nullable();
            $table->unsignedBigInteger('tipo_pago_id')->nullable();
            $table->foreign('tipo_pago_id')->references('id')->on('payment_types')->onDelete('cascade');                                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
