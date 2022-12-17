<?php

namespace Database\Seeders;

use App\Models\Perro;
use App\Models\Interaccion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        $perro = Perro::factory()->create();

        $posts = Interaccion::factory()
            ->count(10)
            ->create();
    }
}
