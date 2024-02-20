<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class TokenService
{
    public function isTokenValid($user)
    {

        $token = $user->tokens()->first();

        return !$token || ($this->isTokenAbilitiesValid($token->abilities));
    }

    protected function isTokenAbilitiesValid($abilities)
    {
        $decodedAbilities = json_decode($abilities, true);

        return isset($decodedAbilities['expires_in']) && now()->lessThan($decodedAbilities['expires_in']);
    }
}

