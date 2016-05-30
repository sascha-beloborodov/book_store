<?php

namespace App\Auth;

use App\Models\User;

class Auth {

    /**
     * get current user
     * @return mixed
     */
    public function user()
    {
        return User::where('id', $_SESSION['user'])->first();
    }

    /**
     * @return int
     */
    public function getUserId() 
    {
        if (isset($_SESSION['user'])) {
            return User::where('id', $_SESSION['user'])->first()->id;
        }
        else {
            return 0;
        }
    }

    /**
     * checking user
     * @return bool
     */
    public function check()
    {
        return isset($_SESSION['user']);
    }
    
    public function logOut()
    {
        unset($_SESSION['user']);
    }

    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }
        
        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }
}