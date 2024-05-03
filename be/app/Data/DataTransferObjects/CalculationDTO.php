<?php

namespace App\Data\DataTransferObjects;

use App\Abstract\DataTransferObject;

class CalculationDTO extends DataTransferObject
{
    /**
     * @param ?int $id
     * @param ?int $userId
     * @param int $purchasedCurrencyId
     * @param float $exchangeRate
     * @param float $purchasedAmount
     * @param float $surchargePercentage
     * @param float $surchargeAmount
     * @param float $discountPercentage
     * @param float $discountAmount
     * @param float $totalPrice
     */
    public function __construct(
        private readonly ?int $id,
        private readonly ?int $userId,
        private readonly int $purchasedCurrencyId,
        private readonly float $exchangeRate,
        private readonly float $purchasedAmount,
        private readonly float $surchargePercentage,
        private readonly float $surchargeAmount,
        private readonly float $discountPercentage,
        private readonly float $discountAmount,
        private readonly float $totalPrice
    )
    {
    }

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ?int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getPurchasedCurrencyId(): int
    {
        return $this->purchasedCurrencyId;
    }

    /**
     * @return float
     */
    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }

    /**
     * @return float
     */
    public function getPurchasedAmount(): float
    {
        return $this->purchasedAmount;
    }

    /**
     * @return float
     */
    public function getSurchargePercentage(): float
    {
        return $this->surchargePercentage;
    }

    /**
     * @return float
     */
    public function getSurchargeAmount(): float
    {
        return $this->surchargeAmount;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * @return float
     */
    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @return array
     */
    public function toResourceArray(): array
    {
        return [
            'purchased_currency_id' => $this->purchasedCurrencyId,
            'exchange_rate'         => $this->exchangeRate,
            'purchased_amount'      => $this->purchasedAmount,
            'discount_percentage'   => $this->discountPercentage,
            'discount_amount'       => $this->discountAmount,
            'total_price'           => $this->totalPrice,
        ];
    }
}
