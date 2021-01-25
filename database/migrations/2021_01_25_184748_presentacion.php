<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Presentacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtpresentacion', function (Blueprint $table) {
            $table->string('claveArticulo',100);
            $table->string('clavePresentacion',100);
            $table->string('descripcion',500);
            $table->decimal('cantidad',18,3);
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
        Schema::dropIfExists('dtpresentacion');
    }
}
