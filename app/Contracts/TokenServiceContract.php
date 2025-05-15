<?php

namespace App\Contracts;

interface TokenServiceContract
{
    public function generateToken(): string;
}
