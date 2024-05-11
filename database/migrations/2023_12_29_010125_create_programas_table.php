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
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landing_eventos_id')->nullable();
            $table->string('dia')->nullable();
            $table->date('fecha')->nullable();
            $table->string('horario')->nullable();
            $table->string('modulo_conferencia')->nullable();
            $table->string('coordinador_profesor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
