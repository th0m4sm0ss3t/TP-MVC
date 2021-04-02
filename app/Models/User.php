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