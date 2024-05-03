<?php

use App\Console\Commands\CacheRatesCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CacheRatesCommand::class)->twiceDaily();
