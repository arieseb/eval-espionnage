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
        $pattern = '/^([\wéèêëàùôïî]{1,})( |-)?([\wéèêëàùôïî]{1,})( |-)?([\wéèêëàùôïî]{1,})$/';
        if (!filter_var($string, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]])) {
            $message = 'La chaîne de caractères "'. $string .'" n\'est pas valide, seulement les caractères alphanumériques et les tirets sont acceptés';
            throw new ValidationException($message);
        }
        return $string;
    }

    /**
     * @throws ValidationException
     */
    public function stringValidation($string)
    {
        $pattern = '/^([a-zA-Zéèêëàùôïî]{1,})( |-)?([a-zA-Zéèêëàùôïî.]{1,})( |-)?([\wéèêëàùôïî]{1,})$/';
        if (!filter_var($string, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]])) {
            $message = 'La chaîne de caractères "'. $string .'" n\'est pas valide, seulement les caractères alphabétiques, les tirets et éventuellement un point sont acceptés';
            throw new ValidationException($message);
        }
        return $string;
    }
}