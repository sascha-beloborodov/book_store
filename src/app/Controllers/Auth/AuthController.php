<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use App\Validation\Validator;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\Twig;
use Respect\Validation\Validator as V;

/**
 * Class AuthController
 * @property  validator Validator
 * @property  router Router
 * @property  view Twig
 * @package App\Controllers\Auth
 */
class AuthController extends Controller {



    public function postSignIn(Request $request, Response $response, $args)
    {
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'Could not signin');
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignOut(Request $request, Response $response, $args)
    {
        $this->auth->logOut();
        return $response->withRedirect($this->router->pathFor('home'));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return static
     */
    public function postSignUp(Request $request, Response $response, $args)
    {
        /**
         * @var Validator $validation
         */
        $validation = $this->validator->validate($request, [
            'email' => V::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name' => V::noWhitespace()->notEmpty()->alpha(),
            'password' => V::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        $this->flash->addMessage('info', 'You have been signed up');

        $this->auth->attempt(
            $user->email,
            $request->getParam('password')
        );

        return $response->withRedirect($this->router->pathFor('home'));
    }

}
