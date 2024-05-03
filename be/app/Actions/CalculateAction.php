<?php

namespace App\Actions;

use App\Abstract\CalculatorFactory;
use App\Data\DataTransferObjects\CalculationDTO;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Models\Currency;

class CalculateAction
{
    /**
     * @param  Currency $currency
     * @param  ExchangeCurrencyDTO $dto
     *
     * @return ?CalculationDTO
     */
    public function run(Currency $currency, ExchangeCurrencyDTO $dto): ?CalculationDTO
    {
        return CalculatorFactory::create($currency)->calculate(new ExchangeCurrencyDTO(
            purchasedCurrencyId: $dto->getPurchasedCurrencyId(),
            amount: $dto->getAmount()
        ));
    }
}
