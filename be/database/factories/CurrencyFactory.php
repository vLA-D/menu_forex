<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            Currency::NAME                 => fake()->word(),
            Currency::SYMBOL               => fake()->currencyCode(),
            Currency::EXCHANGE_RATE        => round(mt_rand() / mt_getrandmax(), 6),
            Currency::SURCHARGE_PERCENTAGE => random_int(0, 20),
            Currency::DISCOUNT_PERCENTAGE  => random_int(0, 3),
        ];
    }
}
