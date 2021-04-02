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
   
        // 2. On récupère l'utilisateur demandé
        $user = User::findByEmail($email);

        // 3. L'utilisateur est-il trouvé ?
        if ($user === false) {
            dump('Utilisateur non trouvé');
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
                dump('Mot de passe PAS OK');
            }
        }
    }


    public function signup()
    {
        $this->show('user/signup', [
            'title' => 'S\'inscrire',
        ]);
    }

    public function checkSignup() {

    }
}