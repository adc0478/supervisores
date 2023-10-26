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
        Schema::create('obs_maquinas', function (Blueprint $table) {
            $table->id('idobs_maquina');
            $table->string('detalle');
            $table->decimal('peroxido');
            $table->unsignedBigInteger('registro_idregistro');
            $table->foreign('registro_idregistro')->references('idregistro')->on('registros');
            $table->unsignedBigInteger('maquina_idmaquina');
            $table->foreign('maquina_idmaquina')->references('idmaquina')->on('maquinas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obs_maquinas');
    }
};
