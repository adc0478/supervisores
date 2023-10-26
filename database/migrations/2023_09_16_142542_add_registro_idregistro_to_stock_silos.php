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
        Schema::table('stock_silos', function (Blueprint $table) {
            $table->unsignedBigInteger('registro_idregistro');
            $table->foreign('registro_idregistro')->references('idregistro')->on('registros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_silos', function (Blueprint $table) {
           $table->dropColumn('registro_idregistro');
        });
    }
};
