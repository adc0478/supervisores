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
        Schema::create('lavados', function (Blueprint $table) {
            $table->id('idlavado');
            $table->string('tipo');
            $table->string('hora');
            $table->unsignedBigInteger('registro_idregistro');
            $table->foreign('registro_idregistro')->references('idregistro')->on('registros');

            $table->unsignedBigInteger('equipo_idequipo');
            $table->foreign('equipo_idequipo')->references('idequipo')->on('equipos');

            $table->unsignedBigInteger('tanque_idtanque');
            $table->foreign('tanque_idtanque')->references('idtanque')->on('tanques');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lavados');
    }
};
