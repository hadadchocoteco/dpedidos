<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtsucursales', function (Blueprint $table) {
            $table->bigIncrements('idSucursal');
            $table->string('sucursal',100)->nullable();
            $table->string('claveSucursal',50)->nullable();
            $table->integer('idEmpresa')->nullable();
            $table->integer('idEstado')->nullable();
            $table->integer('usuariosXSucursal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtsucursales');
    }
}
