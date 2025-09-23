<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'name' => $faker->name(),
            'cpf' => $faker->cpf(),
            'email' => $faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'department' => $faker->randomElement(['Administrativo', 'RH', 'Produção', 'Engenharia', 'Financeiro', 'TI']),
            'occupation' => $faker->randomElement(['Auxiliar Administrativo', 'Auxiliar de Escritório', 'Soldador', 'Engenheiro de Segurança', 'Contador', 'Desenvolvedor']),
            'admission' => $faker->dateTimeBetween('-5 year', 'now'),
            'birth_date' => $faker->dateTimeBetween('-60 year', '-18 year'),
            'gender' => $faker->randomElement(['Masculino', 'Feminino', 'Prefiro não dizer']),
            'marital_status' => $faker->randomElement(['Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Viúvo(a)']),
            'work_shift' => $faker->randomElement(['Diurno', 'Vespertino', 'Noturno']),
            'education_level' => $faker->randomElement(['Ensino Médio Completo', 'Ensino Superior Incompleto', 'Ensino Superior Completo']),
        ];
    }
}
