<?php

namespace App\Tasks;

use App\Data\DataTransferObjects\CalculationDTO;
use App\Models\Order;
use App\Models\User;

class CreateOrderTask
{
    /**
     * @param  CalculationDTO $dto
     * @param  User $user
     *
     * @return ?Order
     */
    public function run(CalculationDTO $dto, User $user): ?Order
    {
        return Order::create(array_merge([Order::USER_ID => $user->id], $dto->toArray()));
    }
}
