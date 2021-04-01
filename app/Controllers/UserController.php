<?php

class UserController extends MainController
{
    public function login()
    {
        $this->show('login', [
            'title' => 'Se connecter',
        ]);
    }
}