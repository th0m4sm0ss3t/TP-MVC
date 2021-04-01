<?php

namespace TPMVC\Controllers;

use TPMVC\Models\User;

class UserController extends MainController
{
    public function login()
    {
        $this->show('login', [
            'title' => 'Se connecter',
        ]);
    }
}