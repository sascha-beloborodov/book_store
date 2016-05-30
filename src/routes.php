<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/templates/{name}', function ($request, $response, $args) {
    $directory = ROOT_DIR . '/templates/js_views/';
    $file = str_replace(['.html', '.phtml'], '', $args['name']);
    require $directory .  $file . '.phtml';
});


$app->get('/books', 'BooksController:index')->setName('books');
$app->post('/books/add', 'BooksController:add')->add(new \App\Middleware\AuthMiddleware($container));
$app->post('/books/upload', 'BooksController:uploadFile')->add(new \App\Middleware\AuthMiddleware($container));
$app->get('/books/show/{id}', 'BooksController:show');
$app->put('/books/edit/{id}', 'BooksController:store')->add(new \App\Middleware\AuthMiddleware($container));
$app->delete('/books/delete/{id}', 'BooksController:delete')->add(new \App\Middleware\AuthMiddleware($container));


$app->group('/auth', function() {
    $this->post('/signup', 'AuthController:postSignUp');
    $this->post('/signin', 'AuthController:postSignIn');
})->add(new \App\Middleware\GuestMiddleware($container));


$app->group('/auth', function() {
    $this->get('/signout', 'AuthController:getSignOut')->setName('auth.signout');
})->add(new \App\Middleware\AuthMiddleware($container));

