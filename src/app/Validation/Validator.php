<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;

class Validator {

    private $errors;

    /**
     * @param Request $request
     * @param array $rules
     * @return Validator $this
     */
    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            }
            catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}