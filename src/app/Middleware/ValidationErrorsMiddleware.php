<?php

namespace App\Middleware;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class ValidationErrorsMiddleware extends Middleware {

    public function __invoke(Request $request, Response $response, $next)
    {
        if (!empty($_SESSION['errors'])) {
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        }
        unset($_SESSION['errors']);
        return $next($request, $response);
    }
}