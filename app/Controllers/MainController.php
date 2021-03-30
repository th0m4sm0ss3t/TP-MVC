<?php

class MainController
{
    // Home
    public function home(){
        // On appelle notre fonction d'affichage
        // Premier argument : le nom de la page à inclure
        // Second argument : le tableau (associatif) des données à utiliser
        $this->show('index', [ // ici 'index' = $viewName de la function show
            'title' => 'Welcome',
            'currentNavLink' => 'index',
        ]); 
    }

    public function error404()
    {
        // On modifie le status code de la réponse HTTP
        http_response_code(404);
        
        $this->show('error404', [
            'title' => 'Not found',
            // On invalide le navLink
            'currentNavLink' => 'null',
        ]);
    }

    // $viewVars = paramètre optionnel (car possède une valeur par défaut, ici, tableau vide)
    public function show($viewName, $viewVars = []) {

    // On inclut l'entête HTML
    require __DIR__.'/../views/header.tpl.php';
    // On inclut le contenu DYNAMIQUEMENT en fonction de la page demandée via $viewNanme de a function show
    require __DIR__.'/../views/'.$viewName.'.tpl.php';
    // On inclut le pied de page
    require __DIR__.'/../views/footer.tpl.php';
}
}