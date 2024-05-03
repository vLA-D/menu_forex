<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency.php.
 *
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property float $exchange_rate
 * @property int $surcharge_percentage
 * @property int $discount_percentage
 */
class Currency extends Model
{
    use HasFactory;

    const ID = 'id';
    const NAME = 'name';
    const SYMBOL = 'symbol';
    const EXCHANGE_RATE = 'exchange_rate';
    const SURCHARGE_PERCENTAGE = 'surcharge_percentage';
    const DISCOUNT_PERCENTAGE = 'discount_percentage';

    protected $fillable = [
        self::NAME,
        self::SYMBOL,
        self::EXCHANGE_RATE,
        self::SURCHARGE_PERCENTAGE,
        self::DISCOUNT_PERCENTAGE,
    ];
}
