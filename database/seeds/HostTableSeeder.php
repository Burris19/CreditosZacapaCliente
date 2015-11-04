<?php

use Illuminate\Database\Seeder;

class HostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Repositories\Host\Host::class)->create([
            'codigo' => 'A25',
            'nombre' => 'Servidor Central',
            'direccion' => 'Guatemala,Guatemala'

        ]);
    }
}
