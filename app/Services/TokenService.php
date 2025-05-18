<?php

namespace App\Services;

use App\Contracts\TokenServiceContract;
use Illuminate\Support\Str;

/**
 * TokenService class
 *
 * Service for generating unique tokens
 */
class TokenService implements TokenServiceContract
{
    /**
     * Generates a random 32-character token
     *
     * @return string The generated token
     */
    public function generateToken(): string
    {
        return Str::random(32);
    }
}
