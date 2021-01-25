<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtarticulos', function (Blueprint $table) {
            $table->string('claveArticulo',300)->nullable();
            $table->string('descripcion',800)->nullable();
            $table->decimal('existencia',18,2)->nullable();
            $table->integer('presentacionPrincipal')->nullable();
            $table->integer('moneda')->nullable();
            $table->decimal('iva',18,2)->nullable();
            $table->string('estado',15)->nullable();
            $table->integer('iepstipo')->nullable();
            $table->decimal('iepsmonto',18,2)->nullable();
            $table->integer('depto')->nullable();
            $table->integer('familia')->nullable();
            $table->integer('marca')->nullable();
            $table->integer('idPromocion')->nullable();
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
        Schema::dropIfExists('dtarticulos');
    }
}
