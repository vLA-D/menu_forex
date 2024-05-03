<?php

namespace App\Console\Commands;

use App\Actions\CacheRatesAction;
use Illuminate\Console\Command;

class CacheRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:cache-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command used to cache currency rates.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        app(CacheRatesAction::class)->run();
    }
}
