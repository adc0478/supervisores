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
        Schema::create('vencimientos', function (Blueprint $table) {
            $table->id('idvencimiento');
            $table->timestamps();
            $table->date('vencimiento');
            $table->integer('control')->length(1);
            $table->double('vda');
            $table->unsignedBigInteger('maquinas_idmaquina');
            $table->foreign('maquinas_idmaquina')->references('idmaquina')->on('maquinas');
            $table->unsignedBigInteger('registros_idregistro');
            $table->foreign('registros_idregistro')->references('idregistro')->on('registros');
            $table->unsignedBigInteger('producto_idproducto');
            $table->foreign('producto_idproducto')->references('idproducto')->on('productos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vencimientos');
    }
};
