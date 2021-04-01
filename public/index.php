<?php

// On inclut autoload de composer
require __DIR__.'/../vendor/autoload.php';

// On inclut nos controllers
require __DIR__.'/../app/Controllers/MainController.php';
require __DIR__.'/../app/Controllers/StoryController.php';
require __DIR__.'/../app/Controllers/UserController.php';

// On inclut nos models
require __DIR__.'/../app/Models/Story.php';
require __DIR__.'/../app/Models/User.php';

// On inclut notre BDD
require __DIR__.'/../app/Utils/Database.php';

// Instanciation de notre object $router
$router = new AltoRouter();
// On définit le chemin vers dossier public
// $router->setBasePath('/Revisions/PHP/TP-MVC/public');
// dump($_SERVER['BASE_URI']);
// $_SERVER['BASE_URI'] -> dynamise le chemin url depuis localhost jusqu'au dossier public transmit à PHP
$router->setBasePath($_SERVER['BASE_URI']);


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
    '/stories', 
    [
        'controller' => 'StoryController',
        'method' => 'storiesList',
    ], 
    'stories'
);

/* READ ONE STORY */
$router->map(
    'GET', 
    '/stories/[i:id]', 
    [
        'controller' => 'StoryController',
        'method' => 'story',
    ], 
    'story'
);

/* AUTHORS LIST */
$router->map(
    'GET', 
    '/authors', 
    [
        'controller' => 'AuthorController',
        'method' => 'authorsList',
    ], 
    'authors'
);

/* VIEW ONE AUTHOR */
$router->map(
    'GET', 
    '/authors/[i:id]', 
    [
        'controller' => 'AuthorController',
        'method' => 'author',
    ], 
    'author'
);

/* LOGIN */
$router->map(
    'GET', 
    '/login', 
    [
        'controller' => 'UserController',
        'method' => 'login',
    ], 
    'login'
);

$router->map(
    'POST', 
    '/login', 
    [
        'controller' => 'UserController',
        'method' => 'checkLogin',
    ], 
    'checkLogin'
);

/* LOGOUT */
$router->map(
    'GET', 
    '/logout', 
    [
        'controller' => 'UserController',
        'method' => 'logout',
    ], 
    'logout'
);


// On vérifie s'il y a un match
// Renvoi soit false, soit infos demandées
$match = $router->match();

// dump($match);

if ($match !== false) {
    // dump($match['target']);
    /* DONNE ex :  array:3 [▼
                    "target" => array:2 [▼
                        "controller" => "StoryController"
                        "method" => "storiesList"
                    ]
                    "params" => array:1 [▼
                        "id" => "2"
                    ]
                    "name" => "story"
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
    // $match['params'] -> permet de récup par ex 1 id de notre url
    $controller->$methodName($match['params']);
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
// permet d'utiliser dump pour débuguer || ex : dump($currentUrl);