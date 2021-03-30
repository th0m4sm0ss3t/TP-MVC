<?php

// On inclut autoload de composer
require __DIR__.'/../vendor/autoload.php';

// On inclut nos classes
require __DIR__.'/../app/Controllers/MainController.php';
require __DIR__.'/../app/Controllers/StoryController.php';

// On veut inclure la bonne page selon le paramètre "page"
// reçu en paramètre GET

// Instanciation de notre object $router
$router = new AltoRouter();
// On définit le chemin vers dossier public
$router->setBasePath('/Revisions/PHP/TP-MVC/public');

/* HOME */
$router->map(
    'GET', // méthode HTTP
    '/', // url
    [
        'controller' => 'MainController', // destination vers controller à utiliser
        'method' => 'home', // destination vers méthode du controller à utiliser
    ], 
    'home' // nom de la route
);

/* STORIES LIST */
$router->map(
    'GET', 
    '/list', 
    [
        'controller' => 'StoryController',
        'method' => 'storiesList',
    ], 
    'list'
);

// On vérifie s'il y a un match
// Renvoi soit false, soit infos demandées
$match = $router->match();

dump($match);

if ($match !== false) {
    // dump($match['target']);
    /* DONNE : array:2 [
            "controller" => "MainController"
            "method" => "home"
        ]
    */
    // on appelle notre page
    // Via le controller ...
    $controllerName = $match['target']['controller'];
    // ... et sa méthode
    $methodName = $match['target']['method'];

    // On instancie un objet $controller dynamiquement
    $controller = new $controllerName();
    // On appelle la méthode souhaitée dynamiquement
    $controller->$methodName();
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