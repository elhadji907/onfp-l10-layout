<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['M.', 'Mme']);
        $users_id = User::all()->random()->id;


        return [
            'civilite' => $gender,
            'firstname' => fake()->name(),
            'name' => fake()->name(),
            'telephone' => $this->faker->unique(true)->numberBetween(70, 79).rand(10, 99).rand(10, 99).rand(0, 9).rand(0, 9).rand(0, 9),
            'adresse' => fake()->address(),
            'lieu_naissance' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'username' => $faker->username,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'date_naissance' => $faker->date($format = 'Y-m-d', $max = '-20 years'),
            'created_by' => function () use ($users_id) {
                return $users_id;
            },
            'updated_by' =>function () use ($users_id) {
                return $users_id;
            },
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
