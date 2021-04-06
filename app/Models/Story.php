<?php

namespace TPMVC\Models;

use TPMVC\Utils\Database;

use PDO;

class Story
{
    // Propriétés qui représentent les champs de la table stories
    // On les nomme de la même façon
    private $stories_id;
    private $stories_title;
    private $stories_content;
    private $stories_created_at;
    private $stories_users_id;

    // Récupérer une liste d'histoires
    public function findAllStories()
    {
        // SQL
        $sql = "SELECT stories.stories_id, stories.stories_title, stories.users_id, users.username FROM stories INNER JOIN users ON stories.users_id = id";
        // On récupère une insatnce de PDO via Database
        $pdo = Database::getPDO();
        // On exécute la requête
        $pdoStatement = $pdo->query($sql);
        // Si on souhaite récupérer des objets, on utilise l'option FETCH_CLASS + le nom de la classe
        $stories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'TPMVC\Models\Story');
        // Si on souhaite utiliser des taleaux associatifs on utilise l'option FETCH_ASSOC
        //$stories = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $stories; // Un tableau d'objets
    }

    // Récupérer une seule d'histoire via son id
    public static function findOneStoryById($story_id)
    {
        // SQL
        $sql = "SELECT stories.stories_id, stories.stories_title, stories.stories_content, stories.users_id, users.username FROM stories INNER JOIN users ON stories.users_id = id WHERE stories_id = $story_id";
        // On récupère PDO via Database
        $pdo = Database::getPDO();
        // On exécute la requête
        $pdoStatement = $pdo->query($sql);
        
        // Si on souhaite utiliser des taleaux associatifs on utilise l'option FETCH_ASSOC
        //$story = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        //$story = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'TPMVC\Models\Story');
        $story = $pdoStatement->fetchObject(self::class);

        return $story; // Un objet
    }

    public function findAuthorStoriesById($author_id)
    {
        // On récupère PDO via Database
        $pdo = Database::getPDO();

        // SQL
        $sql = "SELECT stories.stories_id, stories.stories_title, stories.stories_content, stories.users_id, users.username FROM stories INNER JOIN users ON stories.users_id = id WHERE users_id = $author_id";

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        $pdoStatement->execute(); 

        $stories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'TPMVC\Models\Story');

        return $stories; // Un tableau d'objets
    }

    public static function findByTitle($stories_title)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM stories WHERE stories_title = :stories_title";
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':stories_title', $stories_title, PDO::PARAM_STR);
        $pdoStatement->execute();

        $user = $pdoStatement->fetchObject(self::class);

        return $user;
    }

    // Ajoute une histoire liée à son user en database
    public function insertStory($user_id)
    {
        // PDO
        $pdo = Database::getPDO();

        // Requête pour recupérer l'id du user qui poste l'histoire
        $sqlForUserId = "SELECT id FROM users WHERE id = $user_id";
        
        // La requête
        $sql = "INSERT INTO `stories` (`stories_title`, `stories_content`, `users_id`) VALUES (:stories_title, :stories_content, ($sqlForUserId))";

        //dump($sql);

        // On prépare la requête
        $pdoStatement = $pdo->prepare($sql);

        // On binde
        $pdoStatement->bindParam(":stories_title", $this->stories_title, PDO::PARAM_STR);
        $pdoStatement->bindParam(":stories_content", $this->stories_content, PDO::PARAM_STR);
        //$pdoStatement->bindParam(":users_id", $user_id, PDO::PARAM_INT);

        // Execute exécute la requête et retourne le nombre de lignes ajoutées
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

    // Maj d'une histoire
    public function updateStory($story_id)
    {
        // On récupère PDO via Database
        $pdo = Database::getPDO();

        // SQL
        $sql = "UPDATE `stories` SET `stories_title` = :stories_title, `stories_content` = :stories_content WHERE `stories_id` = $story_id";

        // dump($sql);

        // On prépare la requête
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindParam(":stories_title", $this->stories_title, PDO::PARAM_STR);
        $pdoStatement->bindParam(":stories_content", $this->stories_content, PDO::PARAM_STR);

        $updatedRows = $pdoStatement->execute();

        // On retourne VRAI, si au moins une ligne ajoutée
        return ($updatedRows > 0);
    }

    public function deleteStory($stories_id) 
    {
        // On récupère PDO via Database
        $pdo = Database::getPDO();

        // SQL
        $sql = "DELETE FROM stories WHERE stories_id = :stories_id";

        // On prépare la requête
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':stories_id', $stories_id, PDO::PARAM_INT);

        $deletedRow = $pdoStatement->execute();

        // On retourne VRAI, si au moins une ligne supprimée
        return ($deletedRow > 0);
    }

    
    /**
     * Get the value of stories_id
     */ 
    public function getStories_id()
    {
        return $this->stories_id;
    }

    /**
     * Set the value of stories_id
     *
     * @return  self
     */ 
    public function setStories_id($stories_id)
    {
        $this->stories_id = $stories_id;

        return $this;
    }

    /**
     * Get the value of stories_title
     */ 
    public function getStories_title()
    {
        return $this->stories_title;
    }

    /**
     * Set the value of stories_title
     *
     * @return  self
     */ 
    public function setStories_title($stories_title)
    {
        $this->stories_title = $stories_title;

        return $this;
    }

    /**
     * Get the value of stories_content
     */ 
    public function getStories_content()
    {
        return $this->stories_content;
    }

    /**
     * Set the value of stories_content
     *
     * @return  self
     */ 
    public function setStories_content($stories_content)
    {
        $this->stories_content = $stories_content;

        return $this;
    }

    /**
     * Get the value of stories_created_at
     */ 
    public function getStories_created_at()
    {
        return $this->stories_created_at;
    }

    /**
     * Set the value of stories_created_at
     *
     * @return  self
     */ 
    public function setStories_created_at($stories_created_at)
    {
        $this->stories_created_at = $stories_created_at;

        return $this;
    }

    /**
     * Get the value of stories_user_id
     */ 
    public function getStories_users_id()
    {
        return $this->stories_users_id;
    }

    /**
     * Set the value of stories_user_id
     *
     * @return  self
     */ 
    public function setStories_users_id($stories_users_id)
    {
        $this->stories_users_id = $stories_users_id;

        return $this;
    }
}
