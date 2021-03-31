<?php

class UserController extends MainController
{
    public function login()
    {
        $this->show('login', [
            'title' => 'Se connecter',
        ]);
    }

    public function story($params)
    {
        $this->show('story', [
            'title' => 'Histoires',
            'story_id' => $params['id'],
        ]);
    }
}