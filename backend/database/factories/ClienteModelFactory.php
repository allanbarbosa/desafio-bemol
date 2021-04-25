<?php

namespace Database\Factories;

use App\Models\ClienteModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClienteModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'clie_nome_completo' => $this->faker->name(),
            'clie_cpf' => $this->faker->cpf(false),
            'clie_email' => $this->faker->email(),
            'clie_data_nascimento' => $this->faker->date('Y-m-d'),
            'clie_celular' => $this->faker->cellphoneNumber(),
            'clie_cep' => $this->faker->postcode,
            'clie_endereco' => $this->faker->streetAddress,
            'clie_complemento' => $this->faker->secondaryAddress,
            'clie_bairro' => $this->faker->citySuffix,
            'clie_municipio' => $this->faker->city,
            'clie_estado' => $this->faker->state,
        ];
    }
}
