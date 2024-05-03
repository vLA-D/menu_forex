<?php

namespace App\Actions;

use App\Abstract\CalculatorFactory;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Models\Order;
use App\Tasks\GetCurrencyById;
use App\Tasks\GetOrCreateUserTask;

readonly class ExchangeCurrencyAction
{
    /**
     * @param GetCurrencyById $getCurrencyById
     * @param GetOrCreateUserTask $getOrCreateUserTask
     */
    public function __construct(private GetCurrencyById $getCurrencyById, private GetOrCreateUserTask $getOrCreateUserTask)
    {
    }

    /**
     * @param  ExchangeCurrencyDTO $dto
     *
     * @return ?Order
     */
    public function run(ExchangeCurrencyDTO $dto): ?Order
    {
        $currency = $this->getCurrencyById->run($dto->getPurchasedCurrencyId());
        $calculator = CalculatorFactory::create($currency);

        $calculation = $calculator->calculate($dto);
        $user = $this->getOrCreateUserTask->run($dto->getEmail());

        return $calculator->createOrder($calculation, $user);
    }
}
