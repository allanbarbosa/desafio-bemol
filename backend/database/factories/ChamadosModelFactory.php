<?php

namespace Database\Factories;

use App\Models\ChamadosModel;
use App\Models\ClienteModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChamadosModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChamadosModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cham_titulo' => $this->faker->title(),
            'cham_texto' => $this->faker->text(),
            'cham_criado_em' => $this->faker->date('Y-m-d'),
            'cham_canal_criado' => $this->faker->slug(),
            'cliente_id' => ClienteModel::all()->random()->clie_id,
        ];
    }
}
