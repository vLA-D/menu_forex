<?php

namespace Tests\Unit;


use App\Actions\ExchangeCurrencyAction;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversMethod(ExchangeCurrencyAction::class, 'run')]
class ExchangeCurrencyActionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_exchanges_currency()
    {
        $currency = Currency::factory()->create();
        $amount = 501;
        $email = 'email@example.com';

        app(ExchangeCurrencyAction::class)->run(new ExchangeCurrencyDTO(
            purchasedCurrencyId: $currency->id,
            amount: $amount,
            email: $email,
        ));

        $this->assertDatabaseHas('orders', [
            Order::PURCHASED_CURRENCY_ID => $currency->id,
            Order::PURCHASED_AMOUNT      => $amount * 100,
            Order::USER_ID               => User::where(User::EMAIL, $email)->first()->id,
        ]);
    }
}
