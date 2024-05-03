<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order.php.
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
class Order extends Model
{
    use HasFactory;

    const ID = 'id';
    const USER_ID = 'user_id';
    const PURCHASED_CURRENCY_ID = 'purchased_currency_id';
    const EXCHANGE_RATE = 'exchange_rate';
    const PURCHASED_AMOUNT = 'purchased_amount';
    const SURCHARGE_PERCENTAGE = 'surcharge_percentage';
    const SURCHARGE_AMOUNT = 'surcharge_amount';
    const DISCOUNT_PERCENTAGE = 'discount_percentage';
    const DISCOUNT_AMOUNT = 'discount_amount';
    const TOTAL_PRICE = 'total_price';

    protected $fillable = [
        self::USER_ID,
        self::PURCHASED_CURRENCY_ID,
        self::EXCHANGE_RATE,
        self::PURCHASED_AMOUNT,
        self::SURCHARGE_PERCENTAGE,
        self::SURCHARGE_AMOUNT,
        self::DISCOUNT_PERCENTAGE,
        self::DISCOUNT_AMOUNT,
        self::TOTAL_PRICE,
    ];

    /**
     * @return Attribute
     */
    protected function purchasedAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    /**
     * @return Attribute
     */
    protected function surchargeAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    /**
     * @return Attribute
     */
    protected function discountAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    /**
     * @return Attribute
     */
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    /**
     * @return BelongsTo
     */
    public function purchasedCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
