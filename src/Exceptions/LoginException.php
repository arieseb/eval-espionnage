<?php

namespace App\Exceptions;

use Exception;

class LoginException extends Exception
{
    public function __construct(string $email, string $message)
    {
        $this->message = 'Impossible de connecter l\'adresse ' . $email .'. ' . $message .'.';
    }
}