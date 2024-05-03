<?php

namespace App\Jobs;

use App\Models\Currency;
use App\Services\CurrencyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Call currency service
        if (!$data = app(CurrencyService::class)->getRatesForBaseCurrency()) {
            Log::error('Currency rates not found');
        }

        // Update target currencies
        foreach (Currency::all() as $currency) {
            if (!empty($data[$currency->symbol])) {
                $currency->update([Currency::EXCHANGE_RATE => $data[$currency->symbol]]);

                Cache::put("currency-{$currency->id}", $currency, 60);
            }
        }

        // Save to cache
        Cache::put('currencies', Currency::all(), 60);
    }
}
