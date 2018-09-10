<?php

namespace Models;

use Models\ActiveRecord;
use Models\User;

class Article extends ActiveRecord
{

    protected $title;

    protected $body;

    protected $user_id;



    public function __set($name,$value)
    {
        $this->$name = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getUser()
    {
        return User::find($this->user_id);
    }

    protected static function getTableName() 
    {
        return 'articles';
    }

    // Setters

    public function setTitle(string $str) 
    {
        $this->title = $str ;
    }

    public function setBody(string $str) 
    {
        $this->body = $str;
    }

    public function setUser(User $author) 
    {
        $this->user_id = $author->getId();
    }

}