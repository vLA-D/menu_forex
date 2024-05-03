<?php

namespace App\Actions;

use App\Jobs\CacheRatesJob;

class CacheRatesAction
{
    /**
     * @return void
     */
    public function run(): void
    {
        dispatch(new CacheRatesJob());
    }
}
