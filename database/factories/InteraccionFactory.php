<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perro;
use App\Models\Interaccion;


class InteraccionFactory extends Factory
{
    protected $model = Interaccion::class;

    public function definition()
    {
        return [
            'id_perro_interesado' =>Perro::factory(),
            'id_perro_candidato' =>Perro::factory(),
            'preferencia' => $this->faker->randomElement(['A', 'R']),

        ];
    }
}
