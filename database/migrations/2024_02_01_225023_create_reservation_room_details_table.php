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
        Schema::create('reservation_rooms_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_room_id');
            $table->foreign('reservation_room_id')->references('id')->on('reservation_rooms')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('age')->nullable();
            $table->string('type')->nullable();
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_room_details');
    }
};
