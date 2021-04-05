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
                //if ($password === $user->getPassword()) {
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
        $this->show('user/CRUDUser/signup', [
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

        // On *initialise* un tableau d'erreurs à vide, au départ, on considère qu'il n'y a pas d'erreurs
        // Ce tableau stocke les erreurs pour les réafficher dans le formulaire afin que l'utilisateur sache ce qui ne va pas
        $errorList = [];

        // Vérification adresse e-mail
        if (empty($email)) {
            $errorList[] = "Veuillez entrer une adresse email.";
        } elseif (User::findByEmail($email) !== false) {
            // Adresse existe en database
            $errorList[] = 'Adresse e-mail déja existante dans la base de données.';
        }

        // Vérification pseudo
        if (empty($username)) {
            $errorList[] = "Veuillez entrer un pseudo.";
        } elseif (User::findByUsername($username) !== false) {
            // Pseudo existe en database
            $errorList[] = 'Pseudo déja existant dans la base de données.';
        }

        // Vérification mdp
        if (empty($password)) {
            $errorList[] = "Veuillez entrer un mot de passe.";
        } 
        
        // Vérification longueur mdp > 6 caractères
        if (strlen($password) < 6) {
            $errorList[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        // Vérification confirmation de mdp
        if (empty($confirm_password)) {
            $errorList[] = "Veuillez entrer une confirmation de mot de passe.";
        }

        // Checking if the password entered by the user is equal to the "confim password"
        if ($password !== $confirm_password) {
            $errorList[] = "Les mots de passe ne correspondent pas.";
        }

        //dump($email, $username, $password, $confirm_password);
        // Etape 2, on crée un nouveau user
        $user = New User();

        // On défini les propriétés du user via les SETTERS
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setPassword($password);

        //dump($user);

        // On passe à l'étape suivante UNIQUEMENT s'il n'y a pas d'erreur
        if (empty($errorList)) {
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

        // Si le script arrive ici, c'est qu'il y a des erreurs !
        $this->show('user/CRUDUser/signup', [
            'title' => 'S\'inscrire',
            'errorList' => $errorList,
        ]);
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

    public function resetPassword()
    {
        $this->show('user/CRUDUser/resetPassword', [
            'title' => 'Modifier son mot de passe',
        ]);
    }

    public function checkResetPassword()
    {
        global $router;

        // 1. Récupérer password et confirmation password
        $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

        //dump($new_password, $confirm_password);

        // On *initialise* un tableau d'erreurs à vide, au départ, on considère qu'il n'y a pas d'erreurs
        // Ce tableau stocke les erreurs pour les réafficher dans le formulaire afin que l'utilisateur sache ce qui ne va pas
        $errorList = [];

        // Vérification mdp
        if(empty($new_password)) {
            $errorList[] = "Veuillez entrer un nouveau mot de passe.";
        }

        // Vérification longueur mdp > 6 caractères
        if (strlen($new_password) < 6) {
            $errorList[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        // Vérification confirm mdp
        if(empty($confirm_password)) {
            $errorList[] = "Veuillez entrer une confirmation de mot de passe.";
        }

        // Checking if the password entered by the user is equal to the "confim password"
        if ($new_password !== $confirm_password) {
            $errorList[] = "Les mots de passe ne correspondent pas.";
        }

        $userId = $_SESSION['userId'];

        $user = User::findUserById($userId);

        // dump($user, $userId);

        // On défini les propriétés du user via les SETTERS
        $user->setPassword($new_password);

        // On passe à l'étape suivante UNIQUEMENT s'il n'y a pas d'erreur
        if (empty($errorList)) {
            // On appelle la méthode resetPassword()
            $passwordChangedSuccessfully = $user->resetPassword();
        }

        if ($passwordChangedSuccessfully) {
            // On redirige vers le profil
            header('Location: ' . $router->generate('profil'));
            exit;
        }

        $this->show('user/CRUDUser/resetPassword', [
            'title' => 'Modifier son mot de passe',
            'errorList' => $errorList,
        ]);
    }

    public function deleteProfil()
    {
        $this->show('user/CRUDUser/deleteProfil', [
            'title' => 'Supprimer mon profil',
        ]);
    }

    public function checkDeleteProfil()
    {
        global $router;

        // 1. Récupérer email, password, confirm-password, pseudo
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //dump($email, $password);

        // User's info
        $user = User::findByEmail($email);

        // Get the user's email via their session
        $user_session_email = $_SESSION['userObject']->getEmail();

        // On *initialise* un tableau d'erreurs à vide, au départ, on considère qu'il n'y a pas d'erreurs
        // Ce tableau stocke les erreurs pour les réafficher dans le formulaire afin que l'utilisateur sache ce qui ne va pas
        $errorList = [];

        // Vérification adresse e-mail
        if (empty($email)) {
            $errorList[] = "Veuillez entrer une adresse email.";
        } elseif ($email !== $user_session_email) {
            // Adresse correspond pas au user en session
            $errorList[] = 'L\'adresse e-mail rentrée ne correspond pas à votre compte.';
        }

        // Vérification mdp
        if (empty($password)) {
            $errorList[] = "Veuillez entrer un mot de passe.";
        // mdp ne matche pas avec le compte
        } elseif (!password_verify($password, $user->getPassword())) {
            $errorList[] = "Le mot de passe entré n'est pas valide.";
        }

        // On passe à l'étape suivante UNIQUEMENT s'il n'y a pas d'erreur
        if (empty($errorList)) {
            // On appelle la méthode deleteUser()
            $userDeletedSuccessfully = $user->deleteUser();

            if ($userDeletedSuccessfully) {
                session_destroy();
                
                // On redirige vers la home
                header('Location: ' . $router->generate('profilDeletedConfirmation'));

                // On ne veut pas exécuter de code supplémentaire
                exit;
            } else {
                dump('User non-supprimé');
            }
        }

        $this->show('user/CRUDUser/deleteProfil', [
            'title' => 'Supprimer mon profil',
            'errorList' => $errorList,
        ]);
    }

    public function profilDeletedConfirmation()
    {
        $this->show('user/profilDeletedConfirmation', [
            'title' => 'Profil supprimé',
        ]);
    }
}