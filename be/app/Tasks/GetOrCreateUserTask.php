<?php

namespace App\Tasks;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GetOrCreateUserTask
{
    /**
     * @param  string $email
     *
     * @return User
     */
    public function run(string $email): User
    {
        return User::firstOrCreate([User::EMAIL => $email], [User::PASSWORD => Hash::make(Str::random())]);
    }
}
