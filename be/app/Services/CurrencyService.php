<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    /**
     * @param string $baseCurrency
     * @param string $apiUrl
     * @param string $apiKey
     * @param array|null $data
     */
    public function __construct(
        private readonly string $baseCurrency,
        private readonly string $apiUrl,
        private readonly string $apiKey,
        private ?array $data = null,
    )
    {
    }

    /**
     * @param  ?string $currency
     *
     * @return ?array
     */
    public function getRatesForBaseCurrency(string $currency = null): ?array
    {
        if ($this->data) {
            return $this->data;
        }

        $response = Http::get($this->apiUrl,
            [
                'apikey'        => $this->apiKey,
                'base_currency' => $currency ?? $this->baseCurrency,
            ]);

        if (!$response->successful()) {
            return null;
        }

        $data = [];

        foreach ($response->json('data') as $item) {
            $data[$item['code']] = $item['value'];
        }

        $this->data = $data;

        return $data;
    }
}
