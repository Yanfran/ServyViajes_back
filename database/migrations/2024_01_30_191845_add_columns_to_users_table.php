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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nombre')->nullable()->after('email');
            $table->string('apellido_paterno')->nullable()->after('nombre');
            $table->string('apellido_materno')->nullable()->after('apellido_paterno');
            $table->string('telefono_movil')->nullable()->after('apellido_materno');
            $table->string('ciudad')->nullable()->after('telefono_movil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ciudad');
            $table->dropColumn('telefono_movil');
            $table->dropColumn('apellido_materno');
            $table->dropColumn('apellido_paterno');
            $table->dropColumn('nombre');
        });
    }
};
