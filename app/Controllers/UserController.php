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

                // On redirige vers la home
                header('Location: ' . $router->generate('home'));
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