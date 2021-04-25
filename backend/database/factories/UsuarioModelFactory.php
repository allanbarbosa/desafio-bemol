<?php

namespace Database\Factories;

use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsuarioModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'usua_login' => $this->faker->email,
            'usua_password' => Hash::make($this->faker->password()),
            'cliente_id' => ClienteModel::all()->random()->clie_id,
            'usua_first_access' => true,
            'usua_email_verified_at' => null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'usua_email_verified_at' => null,
            ];
        });
    }
}
