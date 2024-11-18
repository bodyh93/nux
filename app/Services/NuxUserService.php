<?php

namespace App\Services;

use App\Models\NuxUser;

class NuxUserService
{
    public function makeUser(string $username, string $phoneNumber): NuxUser
    {
        return NuxUser::firstOrCreate([
            'username' => $username,
            'phonenumber' => $phoneNumber,
        ]);
    }
}
