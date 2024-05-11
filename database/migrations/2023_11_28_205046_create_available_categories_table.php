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
        Schema::create('available_categories', function (Blueprint $table) {
            $table->id();            
            // Nueva columna para la relación con 'categories'
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->float('costo', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('available_categories');
    }
};
