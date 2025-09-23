<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'name' => $faker->company(),
            'cnpj' => $faker->cnpj(),
            'email' => $faker->unique()->companyEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
