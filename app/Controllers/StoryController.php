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
        global $router;

        // 1) Vérifie le contenu du form
        // dump($_POST);

        // Récupère les données du form via filter_input()
        $stories_title = filter_input(INPUT_POST, 'stories_title', FILTER_SANITIZE_STRING);
        $stories_content = filter_input(INPUT_POST, 'stories_content',FILTER_SANITIZE_STRING);

        // On *initialise* un tableau d'erreurs à vide, au départ, on considère qu'il n'y a pas d'erreurs
        // Ce tableau stocke les erreurs pour les réafficher dans le formulaire afin que l'utilisateur sache ce qui ne va pas
        $errorList = [];

        // Vérification titre
        if (empty($stories_title)) {
            $errorList[] = "Veuillez entrer un titre pour votre histoire.";
        } elseif (Story::findByTitle($stories_title) !== false) {
            // Adresse existe en database
            $errorList[] = 'Titre d\'histoire déja existant dans la base de données.';
        }

        // Vérification contenu
        if (empty($stories_content)) {
            $errorList[] = "Veuillez entrer du contenu pour votre histoire.";
        }

        // Récupère l'id du user via la session
        $user_id = $_SESSION['userId']; 

        // dump($stories_title, $stories_content, $user_id);

        // Etape 2, on crée une nouvelle catégorie
        $story = new Story();

        // On défini les propriétés de la catégorie via les SETTERS
        $story->setStories_title($stories_title);
        $story->setStories_content($stories_content);
        $story->setStories_users_id($user_id);

        // dump($story);

        // On passe à l'étape suivante UNIQUEMENT s'il n'y a pas d'erreur
        if (empty($errorList)) {
            // On appelle la méthode insert()
            $storyAddedSuccessfully = $story->insertStory($user_id);

            if($storyAddedSuccessfully) {
                // Redirection vers login
                header('Location: ' . $router->generate('storyAddConfirmation'));
                exit;
            } else {
                dump('Histoire non-enregistré');
            }
        }

        // Si le script arrive ici, c'est qu'il y a des erreurs !
        $this->show('story/CRUDStory/addStory', [
         'title' => 'Ajouter une histoire',
         'errorList' => $errorList,
        ]);
    }

    public function storyAddConfirmation() {

        $this->show('story/storyAddConfirmation', [
            'title' => 'Histoire ajoutée !',
        ]);;
    }
}