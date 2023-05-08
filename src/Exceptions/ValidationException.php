<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct(string $message)
    {
        $this->message = 'Saisie non valide : ' . $message .'.';
    }
}