<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_order(): void
    {
        $currency = Currency::factory()->create();

        $amount = 501;
        $email = 'email@example.com';

        $response = $this->post(route('orders.store', [
            'purchased_currency_id' => $currency->id,
            'amount'                => $amount,
            'email'                 => $email,
        ]));

        $response->assertStatus(201);

        $this->assertDatabaseHas('orders', [
            Order::PURCHASED_CURRENCY_ID => $currency->id,
            Order::PURCHASED_AMOUNT      => $amount * 100,
            Order::USER_ID               => User::where(User::EMAIL, $email)->first()->id,
        ]);
    }

    #[Test]
    public function it_returns_single_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertStatus(200);

        $this->assertTrue($response->json()['data']['id'] == $order->id);
    }
}
