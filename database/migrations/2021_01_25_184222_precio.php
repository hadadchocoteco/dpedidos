<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Precio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtprecio', function (Blueprint $table) {
            $table->string('clavePresentacion',50);
            $table->integer('noLista');
            $table->decimal('precio',18,3);
            $table->integer('idEmpresa');
            $table->integer('idSucursal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtprecio');
    }
}
