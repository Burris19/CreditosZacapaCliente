<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('id');

            $table->string('codigo');

            $table->integer('idCajero')->unsigned();
            $table->foreign('idCajero')->references('id')->on('cajeros');

            $table->integer('idCredito')->unsigned();
            $table->foreign('idCredito')->references('id')->on('creditos');

            $table->integer('idTipoMoneda')->unsigned();
            $table->foreign('idtipoMoneda')->references('id')->on('tipoMoneda');

            $table->enum('tipoTransaccion',['credito','debito']);

            $table->decimal('monto',8,2);

            $table->string('descripcion');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transacciones');
    }
}
