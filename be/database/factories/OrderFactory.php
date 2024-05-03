<?php

namespace Database\Factories;

use App\Abstract\CalculatorFactory;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        $currency = Currency::factory()->create();

        $calculation = CalculatorFactory::create($currency)->calculate(new ExchangeCurrencyDTO(
            purchasedCurrencyId: $currency->id,
            amount: random_int(1, 100)
        ));

        return [
            Order::USER_ID               => User::factory()->create()->id,
            Order::PURCHASED_CURRENCY_ID => $currency->id,
            Order::EXCHANGE_RATE         => $calculation->getExchangeRate(),
            Order::PURCHASED_AMOUNT      => $calculation->getPurchasedAmount(),
            Order::SURCHARGE_PERCENTAGE  => $calculation->getSurchargePercentage(),
            Order::SURCHARGE_AMOUNT      => $calculation->getSurchargeAmount(),
            Order::DISCOUNT_PERCENTAGE   => $calculation->getDiscountPercentage(),
            Order::DISCOUNT_AMOUNT       => $calculation->getDiscountAmount(),
            Order::TOTAL_PRICE           => $calculation->getTotalPrice(),
        ];
    }
}
