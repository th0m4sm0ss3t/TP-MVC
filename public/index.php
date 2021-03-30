<?php

// On inclut autoload de composer
require __DIR__.'/../vendor/autoload.php';

// On inclut nos classes
require __DIR__.'/../app/Controllers/MainController.php';
require __DIR__.'/../app/Controllers/StoryController.php';

// On veut inclure la bonne page selon le paramètre "page"
// reçu en paramètre GET

if (!empty($_GET['_url'])) {
    $currentUrl = $_GET['_url'];
} else {
    $currentUrl = '/';
}

if ($currentUrl === '/') {
    // On instancie un objet $controller
    $controller = new MainController();
    // On appelle la méthode souhaitée, ici home
    $controller->home();
}
elseif ($currentUrl === '/list') {
    // On instancie un objet $controller
    $controller = new StoryController();
    // On appelle la méthode souhaitée
    $controller->storiesList();
}
else {
    // Alors page non trouvée => 404
    // On instancie un objet $controller
    $controller = new MainController();
    // On appelle la méthode souhaitée
    $controller->error404();
}

// utilisation var-dumper
// -> commande installation terminal : composer require symfony/var-dumper
// permet d'utiliser dump || ex : dump($currentUrl);