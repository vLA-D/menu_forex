<?php

namespace App\Calculators;

use App\Data\DataTransferObjects\CalculationDTO;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use App\Tasks\CreateOrderTask;

class BaseCalculator
{
    /**
     * @param Currency $currency
     */
    public function __construct(private readonly Currency $currency)
    {
    }

    /**
     * @param  ExchangeCurrencyDTO $dto
     *
     * @return ?Order
     */
    public function calculate(ExchangeCurrencyDTO $dto): ?CalculationDTO
    {
        $basePrice = $dto->getAmount() / $this->currency->exchange_rate;

        $surchargeAmount = ($this->currency->surcharge_percentage / 100) * $basePrice;

        $discountAmount = (($basePrice + $surchargeAmount) / 100) * $this->currency->discount_percentage;

        $totalPrice = ($basePrice + $surchargeAmount) - $discountAmount;

        return new CalculationDTO(
            id: null,
            userId: null,
            purchasedCurrencyId: $dto->getPurchasedCurrencyId(),
            exchangeRate: $this->currency->exchange_rate,
            purchasedAmount: round($dto->getAmount(), 2),
            surchargePercentage: round($this->currency->surcharge_percentage, 2),
            surchargeAmount: round($surchargeAmount, 2),
            discountPercentage: round($this->currency->discount_percentage, 2),
            discountAmount: round($discountAmount, 2),
            totalPrice: round($totalPrice, 2),
        );
    }

    /**
     * @param  CalculationDTO $dto
     * @param  User $user
     *
     * @return ?Order
     */
    public function createOrder(CalculationDTO $dto, User $user): ?Order
    {
        return app(CreateOrderTask::class)->run($dto, $user);
    }
}
