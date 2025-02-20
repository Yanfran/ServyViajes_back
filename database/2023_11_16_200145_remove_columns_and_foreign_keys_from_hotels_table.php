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
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropForeign(['id_servicios']);
            $table->dropForeign(['id_gallery']);
            $table->dropColumn('id_servicios');
            $table->dropColumn('id_gallery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedBigInteger('id_servicios');
            $table->foreign('id_servicios')->references('id')->on('services_of_hotels');
            $table->unsignedBigInteger('id_gallery');
            $table->foreign('id_gallery')->references('id')->on('gallery');
        });
    }
};
