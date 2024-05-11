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
        Schema::create('constancies', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->integer('estatus')->nullable();
            $table->unsignedBigInteger('assistants_id')->nullable();
            $table->foreign('assistants_id')->references('id')->on('assistants')->onDelete('cascade');                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constancies');
    }
};
