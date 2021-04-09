<?php

namespace TPMVC\Controllers;

class MainController
{
    public function __construct()
    {
        // On a besoin du nom de la route, présent dans $match
        global $match;

        $routeName = $match['name'];

        // La route contient-elle un token à valider ?
        $this->checkCsrf($routeName);
    }

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
     * Méthode s'occupant de la page d'erreur 404
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
     * Méthode s'occupant de la page d'erreur 403
     *
     * @return void
    **/
    public function error403()
    {
        // On modifie le status code de la réponse HTTP
        http_response_code(403);
        
        $this->show('/error/error403', [
            'title' => 'Erreur 403',
            // On invalide le navLink
            'currentNavLink' => 'null',
        ]);
    }


     /**
     * Méthode s'occupant de la conversion des dates (jours + mois) au format français
     *
     * @return void
    **/
    public function dateToFrench ($date, $format) 
    {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
    }

    /**
    * Vérification du token selon la route demandée
    * 
    * @param string $routeName Route à vérifier
    **/

    private function checkCsrf($routeName)
    {
        // Liste des routes à protéger par un token
        $csrfRoutes = [
            'addStoryCreation',
            'checkUpdateStory',
            'checkResetPassword',
            'checkDeleteProfil',
        ];

        // La route est-elle trouvée ?
        if (!empty($csrfRoutes) && in_array($routeName, $csrfRoutes)) {
            // On tente de récupérer le token CSRF attendu.
            // Si on n'y arrive pas, on considère un token vide, donc invalide.
            // => on regarde dans POST puis dans GET et vide sinon
            // $_POST['secure'] vient d'input hidden du form qui génère le token
            $tokenCsrf = $_POST['secure'] ?? $_GET['secure'] ?? '';

            // On récupère le token en Session (si session expirée, pas de token)
            $sessionToken = $_SESSION['tokenCsrf'] ?? '';

            //dump($sessionToken, $tokenCsrf);

            // On vérifie que c'est token reçu est le même que celui de la session et que le token n'est pas vide
            if ($tokenCsrf !== $sessionToken || empty($tokenCsrf)) {
                // Si non => 403
                http_response_code(403);
                // Puis on affiche la page d'erreur 403
                $this->show('error/error403');
                exit; // <= très important
            }
            else {
                // Si oui, on supprime le token (usage unique - précaution supplémentaire)
                // On supprime le token CSRF actuellement en session, il n'est plus considéré comme valide.
                // Ainsi, on ne pourra pas soumettre plusieurs fois le même formulaire, ni réutiliser ce token.
                unset($_SESSION['tokenCsrf']);
            }

        }
        // La programme continue
    }

    /**
     * Méthode s'occupant de générer un jeton (token) pour la sécurité
     *
     * @return string genereted token en session
    **/
    protected function generateTokenCSRF() 
    {
        // On crée le token en Session

        // md5() => renvoie string sous la forme d'un nombre hexadécimal de 32 caractères
        // time() => renvoie le nb de secondes écoulées depuis 1er janvier 1970
        // mt_rand(1, 10000000) =>  génère une valeur aléatoire entre 1 et 10000000
        // on concatène le tout pour donner un token (ticket) impossible à reproduire
        $_SESSION['tokenCsrf'] = md5(time() . mt_rand(1, 10000000) . mt_rand(1, 10000000));

        // Et on le retourne
        return $_SESSION['tokenCsrf'];
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