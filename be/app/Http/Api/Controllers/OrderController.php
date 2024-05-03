<?php

namespace App\Http\Api\Controllers;

use App\Actions\ExchangeCurrencyAction;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController
{
    /**
     * @param  Order $order
     *
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * @param  CreateOrderRequest $request
     * @param  ExchangeCurrencyAction $action
     *
     * @return OrderResource
     */
    public function store(CreateOrderRequest $request, ExchangeCurrencyAction $action): OrderResource
    {
        return new OrderResource($action->run(new ExchangeCurrencyDTO(
            purchasedCurrencyId: $request->get('purchased_currency_id'),
            amount: $request->get('amount'),
            email: $request->get('email'),
        )));
    }
}
