<?php

namespace TPMVC\Controllers;

class MainController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
    **/
    // Home
    public function home(){
        // On appelle notre fonction d'affichage
        // Premier argument : le nom de la page à inclure
        // Second argument : le tableau (associatif) des données à utiliser
        $this->show('index', [ // ici 'index' = $viewName de la function show
            'title' => 'Accueil',
            'currentNavLink' => 'index',
        ]); 
    }

    /**
     * Méthode s'occupant de la page d'erreur
     *
     * @return void
    **/
    // 404
    public function error404()
    {
        // On modifie le status code de la réponse HTTP
        http_response_code(404);
        
        $this->show('/error/error404', [
            'title' => 'Erreur 404',
            // On invalide le navLink
            'currentNavLink' => 'null',
        ]);
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
    **/

    // $viewVars = paramètre optionnel (car possède une valeur par défaut, ici, tableau vide)
    public function show($viewName, $viewVars = []) {

    // URL absolue vers le dossier public
    $base_uri = $_SERVER['BASE_URI'];
    // On inclut l'entête HTML
    require __DIR__.'/../views/layout/header.tpl.php';
    // On inclut le contenu DYNAMIQUEMENT en fonction de la page demandée via $viewNanme de a function show
    require __DIR__.'/../views/'.$viewName.'.tpl.php';
    // On inclut le pied de page
    require __DIR__.'/../views/layout/footer.tpl.php';
}
}