<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArchivosCabeceraEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtarchivoscabeceraempresa', function (Blueprint $table) {
            $table->bigIncrements('idArchivo');
            $table->string('archivo',150)->nullable();
            $table->string('ruta',300)->nullable();
            $table->string('tipoArchivo',50)->nullable();
            $table->integer('idEmpresa')->nullable();
            $table->integer('idSucursal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtarchivoscabeceraempresa');
    }
}
