<?php

class StoryController extends MainController
{
    public function storiesList()
    {
        $this->show('list', [
            'title' => 'Liste des histoires',
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