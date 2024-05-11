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
        Schema::table('landing_eventos', function (Blueprint $table) {
            $table->longText('facebook')->nullable();
            $table->longText('instagram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->longText('iframe_maps')->nullable();
            $table->boolean('show_hotel')->nullable();
            $table->boolean('show_event')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_eventos', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('whatsapp');
            $table->dropColumn('iframe_maps');
            $table->dropColumn('show_hotel');
            $table->dropColumn('show_event');
        });
    }
};
