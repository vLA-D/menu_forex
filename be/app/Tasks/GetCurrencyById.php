<?php

namespace App\Tasks;

use App\Models\Currency;
use Illuminate\Support\Facades\Cache;

class GetCurrencyById
{
    /**
     * @param  int $id
     *
     * @return ?Currency
     */
    public function run(int $id): ?Currency
    {
        return Cache::remember("currency-{$id}", 60, function () use ($id) {
            return Currency::find($id);
        });
    }
}
