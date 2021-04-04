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
       // 1) Vérifie le contenu du form
       // dump($_POST);

       // Récupère les données du form via filter_input()
       $stories_title = filter_input(INPUT_POST, 'stories_title', FILTER_SANITIZE_STRING);
       $stories_content = filter_input(INPUT_POST, 'stories_content',FILTER_SANITIZE_STRING);

       // Récupère l'id du user via la session
       $user_id = $_SESSION['userId']; 

       // dump($stories_title, $stories_content, $user_id);

       // Etape 2, n crée une nouvelle catégorie
       $story = new Story();

       // On défini les propriétés de la catégorie via les SETTERS
       $story->setStories_title($stories_title);
       $story->setStories_content($stories_content);
       $story->setStories_users_id($user_id);

       // dump($story);

       // On appelle la méthode insert()
       $story->insertStory($stories_title, $stories_content, $user_id);
    }
}