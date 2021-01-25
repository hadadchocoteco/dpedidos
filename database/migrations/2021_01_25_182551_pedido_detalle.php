<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PedidoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtpedidodetalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('folio');
            $table->string('claveArticulo',50);
            $table->string('clavePresentacion',50);
            $table->integer('renglon');
            $table->decimal('precio',18,3);
            $table->decimal('cantidadArticulo',18,3);
            $table->integer('tipoIeps');
            $table->decimal('ieps',18,3);
            $table->dateTime('fechaPedido');
            $table->string('claveCliente',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtpedidodetalle');
    }
}
