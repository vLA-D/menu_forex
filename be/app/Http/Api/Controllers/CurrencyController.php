<?php

namespace App\Http\Api\Controllers;

use App\Actions\CacheRatesAction;
use App\Actions\CalculateAction;
use App\Actions\GetCurrenciesAction;
use App\Data\DataTransferObjects\ExchangeCurrencyDTO;
use App\Http\Requests\CalculateRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CurrencyController
{
    /**
     * @param  GetCurrenciesAction $action
     *
     * @return AnonymousResourceCollection
     */
    public function index(GetCurrenciesAction $action): AnonymousResourceCollection
    {
        return CurrencyResource::collection($action->run());
    }

    /**
     * @param  Currency $currency
     *
     * @return CurrencyResource
     */
    public function show(Currency $currency): CurrencyResource
    {
        return new CurrencyResource($currency);
    }

    /**
     * @param  Currency $currency
     * @param  CalculateAction $action
     * @param  CalculateRequest $request
     *
     * @return JsonResponse
     */
    public function calculate(Currency $currency, CalculateAction $action, CalculateRequest $request): JsonResponse
    {
        $calculation = $action->run($currency, new ExchangeCurrencyDTO(
            purchasedCurrencyId: $currency->id,
            amount: $request->get('amount')
        ));

        return response()->json($calculation->toResourceArray());
    }

    /**
     * @param  CacheRatesAction $action
     *
     * @return JsonResponse
     */
    public function refresh(CacheRatesAction $action): JsonResponse
    {
        $action->run();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
