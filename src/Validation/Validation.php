<?php

namespace App\Validation;

use App\Exceptions\ValidationException;

class Validation
{
    /**
     * @throws ValidationException
     */
    public function codenameValidation($string)
    {
        $pattern = "/^[\p{L}\d\s'-]+$/u";
        if (!preg_match($pattern, $string)) {
            $message = 'Le nom de code "'. $string .'" n\'est pas valide.';
            throw new ValidationException($message);
        }
        return $string;
    }

    /**
     * @throws ValidationException
     */
    public function stringValidation($string)
    {
        $pattern = "/^[\p{L}\d\s']+$/u";
        if (!preg_match($pattern, $string)) {
            $message = 'La chaîne de caractères "'. $string .'" n\'est pas valide';
            throw new ValidationException($message);
        }
        return $string;
    }
}