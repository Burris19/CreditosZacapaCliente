<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idCredito')->unsigned();
            $table->foreign('idCredito')->references('id')->on('creditos');

            $table->decimal('montoCuota',8,2);
            $table->date('fechaPago');
            $table->string('estado');
            $table->decimal('balance',8,2);

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
        Schema::drop('cuotas');
    }
}
