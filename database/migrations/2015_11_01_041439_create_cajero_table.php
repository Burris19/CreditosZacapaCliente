<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajeros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('nombre');
            $table->string('direccion');
            $table->date('fecha');
            $table->integer('idSucursal')->unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursales');
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
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
        Schema::drop('cajeros');
    }
}
