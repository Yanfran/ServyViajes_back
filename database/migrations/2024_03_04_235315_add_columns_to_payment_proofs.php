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
        Schema::table('payment_proofs', function (Blueprint $table) {            
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payment_types')->onDelete('cascade');   
            $table->date('date')->nullable();
            $table->float('amount', $precision = 8, $scale = 2)->nullable();            
            $table->string('motion')->nullable();
            $table->string('voucher')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_proofs', function (Blueprint $table) {
            $table->dropColumn('payment_id');
            $table->dropColumn('date');
            $table->dropColumn('amount');
            $table->dropColumn('motion');
            $table->dropColumn('voucher');            
        });
    }
};
