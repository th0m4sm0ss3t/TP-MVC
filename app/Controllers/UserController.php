<?php

namespace TPMVC\Controllers;

use TPMVC\Models\User;

class UserController extends MainController
{
    public function login()
    {
        $this->show('user/login', [
            'title' => 'Se connecter',
        ]);
    }


    public function signup()
    {
        $this->show('user/signup', [
            'title' => 'S\'inscrire',
        ]);
    }
}