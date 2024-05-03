<?php

namespace App\Tasks;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class GetCurrenciesTask
{
    /**
     * @return Collection
     */
    public function run(): Collection
    {
        return Cache::remember('currencies', 60, function () {
            return Currency::all();
        });
    }
}
