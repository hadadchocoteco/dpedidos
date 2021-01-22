<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticulosPedidoTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtarticulospedidotemp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('claveArticulo',50)->nullable();
            $table->string('clavePresentacion',50)->nullable();
            $table->decimal('costo',18,3)->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('iva',18,3)->nullable();
            $table->integer('iepsTipo')->nullable();
            $table->decimal('iepsMonto',18,3)->nullable();
            $table->decimal('porcendescto',18,3)->nullable();
            $table->integer('idPromocion')->nullable();
            $table->string('clavePromocion',50)->nullable();
            $table->string('claveCliente',30)->nullable();
            $table->string('estatus',45)->nullable();
            $table->integer('idUsuario')->nullable();
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
        //
    }
}
