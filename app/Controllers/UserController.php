<?php

namespace TPMVC\Controllers;

use TPMVC\Models\User;

class UserController extends MainController
{
    public function login()
    {
        $this->show('user/login', [
            'title' => 'Se connecter',
        ]);
    }

    public function logout()
    {
        global $router;

        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        $_SESSION["loggedin"] = false;

        header('Location: ' . $router->generate('login'));
        exit;
    }


    /**
     * POST : Traitement form de login
     */
    public function checkLogin()
    {
        global $router;

        // 1. Récupérer email et password
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // dump($email, $password);
   
        // On *initialise* un tableau d'erreurs à vide, au départ, on considère qu'il n'y a pas d'erreurs
        // Ce tableau stocke les erreurs pour les réafficher dans le formulaire afin que l'utilisateur sache ce qui ne va pas
        $errorList = [];

        // Vérification adresse e-mail
        if (empty($email)) {
            $errorList[] = "Veuillez entrer une adresse email.";
        }

        // Vérification mdp
        if (empty($password)) {
            $errorList[] = "Veuillez entrer un mot de passe.";
        }

        // On passe à l'étape suivante UNIQUEMENT s'il n'y a pas d'erreur
        if (empty($errorList)) {
            // 2. On récupère l'utilisateur demandé
            $user = User::findByEmail($email);

            // 3. L'utilisateur est-il trouvé ?
            if ($user === false) {
                $errorList[] = 'Cette adresse mail ne correspond à aucun compte.';
            } else {
                // Les mots de passe correspondent-ils
                if (password_verify($password, $user->getPassword())) {
                    // On stocke l'id
                    $_SESSION['userId'] = $user->getId();
                    // On stocke le user complet
                    $_SESSION['userObject'] = $user;
                    // On affirme que le user est bien connecté
                    $_SESSION["loggedin"] = true;

                    // On redirige vers la home
                    header('Location: ' . $router->generate('home'));
                    // dump($email, $password, $_SESSION["loggedin"], $_SESSION['userObject']);
                    exit;
                } else {
                    $errorList[] = 'Le mot de passe entré n\'est pas valide.';
                }
            }
        }
        
        // Si le script arrive ici, c'est qu'il y a des erreurs !
        $this->show('user/login', [
            'title' => 'Se connecter',
            'errorList' => $errorList,
        ]);
    }


    public function signup()
    {
        $this->show('user/signup', [
            'title' => 'S\'inscrire',
        ]);
    }

    /*
    register@test.com
    Register Test (username)
    register (mpd)
    */

    public function checkSignup() {
        global $router;

        // 1. Récupérer email, password, confirm-password, pseudo
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

        //dump($email, $username, $password, $confirm_password);
        // Etape 2, on crée un nouveau user
        $user = New User();

        // On défini les propriétés du user via les SETTERS
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setPassword($password);

        //dump($user);

        // On appelle la méthode insert()
        $userAddedSuccessfully = $user->createUser();

        if($userAddedSuccessfully) {
            // Redirection vers login
            header('Location: ' . $router->generate('login'));
            exit;
        } else {
            dump('User non-enregistré');
        }
    }

    public function userProfil() {
        $userId = $_SESSION['userId']; // get user's id

        // On inclu notre model User
        $userModel = new User();

        // On appelle la méthode souhaitée
        $userStoriesInfos = $userModel->findUserStoriesInfos($userId);

        $todaysDate = $this->dateToFrench("now" ,"l j F Y"); // récupère date actuelle au format fr
        $timestamp = time(); // récupère heure actuelle


        $this->show('user/profil', [
            'title' => 'Profil',
            'todaysDate' => $todaysDate,
            'timestamp' => $timestamp,
            'userId' => $userId,
            'userStoriesInfos' => $userStoriesInfos,
        ]);
    }
}