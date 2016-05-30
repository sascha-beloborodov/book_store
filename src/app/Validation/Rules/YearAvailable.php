<?php
namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class YearAvailable extends AbstractRule {

    
    public function validate($input)
    {
        return MIN_YEAR < (int) $input && (int) $input < MAX_YEAR;
    }
}