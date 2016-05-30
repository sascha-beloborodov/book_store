<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class CsrfViewMiddleware extends Middleware {

    public function __invoke(Request $request, Response $response, $next)
    {
//        var_dump($this->container->csrf->getTokenName(), $this->container->csrf->getTokenValue());

        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '<input type="hidden" name="' .
                        $this->container->csrf->getTokenNameKey() .
                        '" id="' . $this->container->csrf->getTokenNameKey() .
                        '" value="' . $this->container->csrf->getTokenName()  . '">' .
                       '<input type="hidden" name="' . $this->container->csrf->getTokenValueKey() .
                        '" id="' . $this->container->csrf->getTokenValueKey() .
                        '" value="' . $this->container->csrf->getTokenValue()  . '">'
        ]);
        return $next($request, $response);
    }
}