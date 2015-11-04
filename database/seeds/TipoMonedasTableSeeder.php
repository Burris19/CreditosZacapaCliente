<?php

use Illuminate\Database\Seeder;

class TipoMonedasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Repositories\TipoMoneda\TipoMoneda::class)->create();
    }
}
