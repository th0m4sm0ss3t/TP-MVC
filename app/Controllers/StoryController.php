<?php

class StoryController extends MainController
{
    public function storiesList()
    {   
        $this->show('list', [
            'title' => 'Liste des histoires',
            'currentNavLink' => '/list',
        ]);
    }
}