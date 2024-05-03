<?php

namespace Tests;

use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @return void
     */
    public function seedCurrencies(): void
    {
        $this->seed(CurrencySeeder::class);
    }
}
