<?php


namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class MatchesPassword extends AbstractRule {
    
    private $password;
    
    public function __construct($password)
    {
        $this->password = $password;
    }

    public function validate($input)
    {
        $oldPassword = $this->password;
        $passwordIsEqual = password_verify($input, $oldPassword); 
        return $passwordIsEqual;
        
    }
}