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
        Schema::create('academic_grades', function (Blueprint $table) {
            $table->id();         
            $table->string('descripcion')->nullable();               
            $table->unsignedBigInteger('events_id');
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');            
            $table->integer('estatus');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_grades');
    }
};
