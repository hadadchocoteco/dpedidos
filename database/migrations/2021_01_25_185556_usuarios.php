<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtusuarios', function (Blueprint $table) {
            $table->bigIncrements('idUsuario');
            $table->string('correo',150)->nullable();
            $table->string('contrasena',100)->nullable();
            $table->string('estado',30)->nullable();
            $table->integer('idEmpresa')->nullable();
            $table->integer('idSucursal')->nullable();
            $table->integer('idJefeInmediato')->nullable();
            $table->string('tipo',20)->nullable();
            $table->string('prefijo',6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtusuarios');
    }
}
