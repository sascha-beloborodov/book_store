<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class AuthMiddleware extends Middleware {

    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$this->container->auth->check()) {
            return $response->withJson(['error' => '1', 'message' => 'Please, sign in before'], 500);
        }
        
        return $next($request, $response);
    }
}