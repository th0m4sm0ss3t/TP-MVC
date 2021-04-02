<?php

namespace TPMVC\Controllers;

use TPMVC\Models\Story;

class StoryController extends MainController
{
    public function storiesList()
    {
        // On inclu notre model Story
        $storyModel = new Story();
        // On appelle la méthode souhaitée
        $stories = $storyModel->findAllStories();

        // dump($stories);

        $this->show('story/list', [
            'title' => 'Liste des histoires',
            'stories' => $stories,
        ]);
    }

    public function story($params)
    {
        // On inclu notre model Story
        $storyModel = new Story();
        // On appelle la méthode souhaitée
        $story = $storyModel->findOneStoryById($params['id']);

        $this->show('story/story', [
            'title' => 'Histoire',
            'story_id' => $params['id'],
            'story' => $story,
        ]);
    }

    public function addStoryView()
    {
        $this->show('story/CRUDStory/addStory', [
            'title' => 'Ajouter une histoire',
        ]);
    }

    public function addStoryCreation()
    {
       
    }
}