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

            $table->string('code');
            $table->enum('tipoTransaccion',['credito','debito']);
            $table->decimal('monto',8,2);
            $table->string('descripcion');
            $table->enum('estado',['registrado','atrasado','sincronizado','adelantado','pendiente']);

            $table->integer('idCajero')->unsigned()->nullable();
            $table->foreign('idCajero')->references('id')->on('cajeros');

            $table->integer('idCredito')->unsigned();
            $table->foreign('idCredito')->references('id')->on('creditos');

            $table->integer('idTipoMoneda')->unsigned();
            $table->foreign('idTipoMoneda')->references('id')->on('tipoMoneda');

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
