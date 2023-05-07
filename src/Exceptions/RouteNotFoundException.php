<?php

namespace App\Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    public function __construct(string $uri)
    {
        $this->message = 'Impossible de trouver la route ' . $uri;
    }
}