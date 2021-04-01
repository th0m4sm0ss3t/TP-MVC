<?php

class StoryController extends MainController
{
    public function storiesList()
    {
        // On inclu notre model Story
        $storyModel = new Story();
        // On appelle la méthode souhaitée
        $stories = $storyModel->findAllStories();

        // dump($stories);

        $this->show('list', [
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

        $this->show('story', [
            'title' => 'Histoires',
            'story_id' => $params['id'],
            'story' => $story,
        ]);
    }
}