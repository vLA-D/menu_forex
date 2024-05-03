<?php

namespace App\Abstract;

use App\Calculators\BaseCalculator;
use App\Calculators\GbpCalculator;
use App\Models\Currency;

class CalculatorFactory
{
    /**
     * @param  Currency $currency
     *
     * @return BaseCalculator
     */
    public static function create(Currency $currency): BaseCalculator
    {
        return match ($currency->symbol) {
            GbpCalculator::SYMBOL => new GbpCalculator($currency),
            default               => new BaseCalculator($currency),
        };
    }
}
