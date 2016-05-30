<?php
namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class YearAvailableException extends ValidationException {

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Invalid public year.'
        ]
    ];
}