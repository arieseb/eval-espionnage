<?php

namespace App\Exceptions;

class QueryException extends \Exception
{
    public function __construct(string $message)
    {
        $this->message = 'Erreur de requête : ' . $message .'.';
    }
}