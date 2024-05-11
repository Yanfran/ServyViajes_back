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
        Schema::create('landing_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('color_fondo')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('logo_evento')->nullable();
            $table->string('logo_asociacion')->nullable();
            $table->longText('que_incluye')->nullable();
            $table->string('pdf_programa')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes(); //borrado logico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_eventos');
    }
};
