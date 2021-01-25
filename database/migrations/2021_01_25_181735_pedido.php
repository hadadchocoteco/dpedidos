<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtpedido', function (Blueprint $table) {
            $table->bigIncrements('folio');
            $table->dateTime('fecha')->nullable();
            $table->string('claveCliente',50)->nullable();
            $table->decimal('subtotal',18,3)->nullable();
            $table->decimal('iva',18,3)->nullable();
            $table->decimal('ieps',18,3)->nullable();
            $table->decimal('total',18,3)->nullable();
            $table->integer('moneda')->nullable();
            $table->string('estado',50)->nullable();
            $table->decimal('porcendescto',18,3)->nullable();
            $table->string('documento',1)->nullable();
            $table->integer('idUsuario')->nullable();
            $table->string('mensaje',50)->nullable();
            $table->dateTime('fechaActualizacion')->nullable();
            $table->string('claveTransaccion',250)->nullable();
            $table->integer('idEmpresa')->nullable();
            $table->integer('idSucursal')->nullable();
            $table->date('fechaRespuestaReq')->nullable();
            $table->string('correoRespuestaReq',200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtpedido');
    }
}
