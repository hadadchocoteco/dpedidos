<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListaPrecios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtlistaprecios', function (Blueprint $table) {
            $table->integer('folio');
            $table->string('claveCliente',100)->nullable();
            $table->string('claveArticulo',100)->nullable();
            $table->decimal('precio',18,3)->nullable();
            $table->date('fechaVigencia')->nullable();
            $table->string('clavePresentacion',45)->nullable();
            $table->integer('moneda')->nullable();
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
        Schema::dropIfExists('dtlistaprecios');
    }
}
