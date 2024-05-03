<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CurrencyResource.php.
 *
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property float $exchange_rate
 * @property int $surcharge_percentage
 * @property int $discount_percentage
 */
class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            Currency::ID            => $this->id,
            Currency::NAME          => $this->name,
            Currency::SYMBOL        => $this->symbol,
            Currency::EXCHANGE_RATE => $this->exchange_rate,
        ];
    }
}
