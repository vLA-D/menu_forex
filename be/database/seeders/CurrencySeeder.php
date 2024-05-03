<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::factory()->createMany([
            [
                Currency::NAME                 => 'Japanese Yen',
                Currency::SYMBOL               => 'JPY',
                Currency::EXCHANGE_RATE        => 107.17,
                Currency::SURCHARGE_PERCENTAGE => 7.5,
                Currency::DISCOUNT_PERCENTAGE  => 0,
            ],
            [
                Currency::NAME                 => 'British Pound',
                Currency::SYMBOL               => 'GBP',
                Currency::EXCHANGE_RATE        => 0.711178,
                Currency::SURCHARGE_PERCENTAGE => 5,
                Currency::DISCOUNT_PERCENTAGE  => 0,
            ],
            [
                Currency::NAME                 => 'Euro',
                Currency::SYMBOL               => 'EUR',
                Currency::EXCHANGE_RATE        => 0.884872,
                Currency::SURCHARGE_PERCENTAGE => 5,
                Currency::DISCOUNT_PERCENTAGE  => 2,
            ],
        ]);
    }
}
