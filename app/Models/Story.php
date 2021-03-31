<?php

class Story
{
    // Propriétés qui représentent les champs de la table Product
    // On les nomme de la même façon
    private $stories_id;
    private $stories_title;
    private $stories_content;
    private $stories_created_at;
    private $stories_users_id;

    
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
