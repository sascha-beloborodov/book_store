<?php
// DIC configuration

use Respect\Validation\Validator as v;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages();
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['auth'] = function($c) {
    return new App\Auth\Auth();
};

$container['modelFactory'] = function($c) {
    return new \App\Factories\ModelFactory();
};

$container['view'] = function ($c) {
    $settings = $c->get('settings')['twig']['template_path'];
    $view = new \Slim\Views\Twig($settings, [
        'cache' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->router,
        $c->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->check() ? $c->auth->user() : null
    ]);

    $view->getEnvironment()->addGlobal('flash', $c->flash);

    return $view;
};

$container['validator'] = function($c) {
    return new \App\Validation\Validator();
};

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($c) use ($capsule) {
    return $capsule;
};

$container['HomeController'] = function($c) {
    return new \App\Controllers\HomeController($c);
};

$container['csrf'] = function($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};

$container['AuthController'] = function($c) {
    return new \App\Controllers\Auth\AuthController($c);
};

$container['BooksController'] = function($c) {
    return new \App\Controllers\BooksController($c);
};



$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('App\\Validation\\Rules\\');
