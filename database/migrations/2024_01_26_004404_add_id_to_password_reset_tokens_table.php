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
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->dropPrimary('password_reset_tokens_email_primary'); //eliminamos la reestriccion primary en email
        });
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->id()->first(); //agregamos un id autoincrementable
        });
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->nullable()->change(); //cambiamos email a nulo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->dropPrimary('password_reset_tokens_id_primary'); //eliminamos la reestricion primary en id
            $table->string('email')->nullable(false)->change(); // cambiamos email a no nulo
            $table->primary('email'); //establecemos email como primary
            $table->dropColumn('id'); // eliminamos la columna id
        });
    }
};
