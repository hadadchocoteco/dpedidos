<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetallePedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtdetallepedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('folio')->nullable();
            $table->string('claveArticulo',200)->nullable();
            $table->decimal('precio',18,3)->nullable();
            $table->integer('renglon')->nullable();
            $table->string('clavePresentacion',20)->nullable();
            $table->integer('idPromocion')->nullable();
            $table->decimal('cantidad',18,3)->nullable();
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
