<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtclientes', function (Blueprint $table) {
            $table->string('claveCliente',200)->nullable();
            $table->string('razonSocial',200)->nullable();
            $table->string('password',100)->nullable();
            $table->decimal('iva',18,3)->nullable();
            $table->integer('noListaPrecio')->nullable();
            $table->decimal('porcendescto',18,3)->nullable();
            $table->string('mailmensajes',200)->nullable();
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
        Schema::dropIfExists('dtclientes');
    }
}
