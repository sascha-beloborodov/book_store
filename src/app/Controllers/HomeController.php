<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class HomeController extends Controller {


    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function index (Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'home.twig');
    }
}
