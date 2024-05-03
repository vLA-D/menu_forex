<?php

namespace App\Calculators;

use App\Data\DataTransferObjects\CalculationDTO;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class GbpCalculator extends BaseCalculator
{
    const SYMBOL = 'GBP';

    /**
     *
     * @param  CalculationDTO $dto
     * @param  User $user
     *
     * @return ?Order
     */
    public function createOrder(CalculationDTO $dto, User $user): ?Order
    {
        $order = parent::createOrder($dto, $user);

        Mail::to($user)->send(new OrderCreated($order));

        return $order;
    }
}
