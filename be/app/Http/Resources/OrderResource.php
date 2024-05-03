<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrderResource.php.
 *
 * @property int $id
 * @property int $user_id
 * @property int $purchased_currency_id
 * @property float $exchange_rate
 * @property int $purchased_amount
 * @property float $surcharge_percentage
 * @property int $surcharge_amount
 * @property float $discount_percentage
 * @property int $discount_amount
 * @property int $total_price
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            Order::ID                  => $this->id,
            Order::EXCHANGE_RATE       => $this->exchange_rate,
            Order::PURCHASED_AMOUNT    => $this->purchased_amount,
            Order::DISCOUNT_PERCENTAGE => $this->when(intval($this->discount_percentage) !== 0, $this->discount_percentage),
            Order::DISCOUNT_AMOUNT     => $this->when(intval($this->discount_amount) !== 0, $this->discount_amount),
            Order::TOTAL_PRICE         => $this->total_price,
            Order::CREATED_AT          => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
