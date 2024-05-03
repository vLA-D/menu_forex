<?php

namespace App\Data\DataTransferObjects;

readonly class ExchangeCurrencyDTO
{
    /**
     * @param int $purchasedCurrencyId
     * @param float $amount
     * @param ?string $email
     */
    public function __construct(
        private int $purchasedCurrencyId,
        private float $amount,
        private ?string $email = null,
    )
    {
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
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
}
