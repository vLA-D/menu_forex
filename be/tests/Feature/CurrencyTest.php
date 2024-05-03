<?php

namespace Tests\Feature;

use App\Abstract\CalculatorFactory;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seedCurrencies();
    }

    #[Test]
    public function it_returns_list_of_currencies(): void
    {
        $response = $this->get(route('currencies.index'));

        $response->assertStatus(200);

        $this->assertTrue(count($response->json()['data']) === Currency::count());
    }

    #[Test]
    public function it_returns_single_currency(): void
    {
        $currency = Currency::first();

        $response = $this->get(route('currencies.show', $currency));

        $response->assertStatus(200);

        $this->assertTrue($response->json()['data']['id'] == $currency->id);
    }

    #[Test]
    public function it_calculates_amount(): void
    {
        $currency = Currency::first();

        $calculation = CalculatorFactory::create($currency)->calculate(new ExchangeCurrencyDTO(
            purchasedCurrencyId: $currency->id,
            amount: 500
        ));

        $response = $this->post(route('currencies.calculate', $currency), ['amount' => 500]);

        $response->assertStatus(200);

        $this->assertEquals($calculation->toResourceArray(), $response->json());
    }

    #[Test]
    public function it_refreshes_currency(): void
    {
        $fakeSymbol = 'ADA';
        $fakeValue = 5.5;

        $currency = Currency::factory()->create([Currency::EXCHANGE_RATE => 50, Currency::SYMBOL => $fakeSymbol]);

        Http::fake(['*' => Http::response(['data' => [['code'  => $fakeSymbol, 'value' => $fakeValue]]])]);

        $response = $this->post(route('admin.currencies.refresh'));

        $response->assertStatus(204);

        $this->assertTrue($currency->fresh()->exchange_rate === $fakeValue);
    }
}
