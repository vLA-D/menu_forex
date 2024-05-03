<?php

namespace App\Actions;

use App\Tasks\GetCurrenciesTask;
use Illuminate\Database\Eloquent\Collection;

readonly class GetCurrenciesAction
{
    /**
     * @param GetCurrenciesTask $task
     */
    public function __construct(private GetCurrenciesTask $task)
    {
    }

    /**
     * @return Collection
     */
    public function run(): Collection
    {
        return $this->task->run();
    }
}
