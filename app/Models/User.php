<?php

namespace TPMVC\Models;

use TPMVC\Utils\Database;

use PDO;

class User
{
    // Propriétés qui représentent les champs de la table Product
    // On les nomme de la même façon
    private $id;
    private $email;
    private $username;
    private $password;
    private $created_at;


    public static function findByEmail($email) {

        // On récupère une insatnce de PDO via Database
        $pdo = Database::getPDO();
        // SQL
        $sql = "SELECT * FROM users WHERE email = :email";
        // On prépare la requête
        $pdoStatement = $pdo->prepare($sql);
        // On binde notre valeur
        $pdoStatement->bindValue(":email", $email, PDO::PARAM_STR);
        // On exécute la requête
        $pdoStatement->execute();
        // On récupère un objet
        $user = $pdoStatement->fetchObject(self::class);
        
        // fectchObject() retourne soit un objet de type AppUser
        // soit false
        return $user;
    }

    public static function findByUsername($username) {

        // On récupère une insatnce de PDO via Database
        $pdo = Database::getPDO();
        // SQL
        $sql = "SELECT * FROM users WHERE username = :username";
        // On prépare la requête
        $pdoStatement = $pdo->prepare($sql);
        // On binde notre valeur
        $pdoStatement->bindValue(":username", $username, PDO::PARAM_STR);
        // On exécute la requête
        $pdoStatement->execute();
        // On récupère un objet
        $user = $pdoStatement->fetchObject(self::class);
        
        // fectchObject() retourne soit un objet de type AppUser
        // soit false
        return $user;
    }

    public static function findUserById($id)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM users WHERE id = :id";
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $user = $pdoStatement->fetchObject(self::class);

        return $user;
    }

    public static function findUserStoriesInfos($userId)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT stories_id, stories_title, stories_created_at, users_id FROM stories WHERE users_id = $userId";
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        $userStoriesInfos = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'TPMVC\Models\User');

        return $userStoriesInfos;
    }

    /* GET ONLY THE DATE OF STORIES FROM 1 USER */
    public static function findDateUserStories($userId)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT stories_created_at FROM stories WHERE users_id = $userId";
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        $userStoriesDate = $pdoStatement->fetchObject(self::class);

        return $userStoriesDate;
    }

    /* CREATE 1 USER */
    public function createUser()
    {
        // PDO
        $pdo = Database::getPDO();

        // SQL
        $sql = "INSERT INTO `users` (`email`, `username`, `password`) VALUES (:email, :username, :password)";

        // dump($sql);

        // On prépare la requête
        $pdoStatement = $pdo->prepare($sql);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT); // For security and against XSS attacks, we use password_hash(); to hash the password.

        $pdoStatement->bindParam(":email", $this->email, PDO::PARAM_STR);
        $pdoStatement->bindParam(":username", $this->username, PDO::PARAM_STR);
        $pdoStatement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);

        //dump($hashedPassword);

        // Exec exécute la requête et retourne le nombre de lignes ajoutées
        $insertedRows = $pdoStatement->execute();

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();
            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
        } else {
            // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné
            return false;
        }
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}