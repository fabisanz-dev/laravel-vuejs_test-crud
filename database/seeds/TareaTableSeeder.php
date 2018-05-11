<?php

use Illuminate\Database\Seeder;
use App\Tarea;

class TareaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tarea::class, 20)->create();
    }
}
