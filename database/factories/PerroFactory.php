<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

use App\Models\Perro;

class PerroFactory extends Factory
{
    protected $model = Perro::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            //'url_foto' => $this->faker->sentence,
            'url_foto' => Http::get('https://dog.ceo/api/breeds/image/random')['message'],
            //const { data } =  await axios.get("https://dog.ceo/api/breeds/image/random")
            'descripcion' => $this->faker->sentence,
        ];
    }
}
