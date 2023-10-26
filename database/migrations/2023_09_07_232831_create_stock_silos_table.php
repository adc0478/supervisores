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
        Schema::create('stock_silos', function (Blueprint $table) {
            $table->id('idstock_silo');

            $table->unsignedBigInteger('silo_idsilo');
            $table->foreign('silo_idsilo')->references('idsilo')->on('silos');

            $table->unsignedBigInteger('producto_idproducto');
            $table->foreign('producto_idproducto')->references('idproducto')->on('productos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_silos');
    }
};
