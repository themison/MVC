<?php

namespace Models;

use Models\ActiveRecord;

class User extends ActiveRecord
{

    private $name;

    private $email;

    protected static $tableName = 'users';


    public function __set($name,$value)
    {
        $this->$name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public static function getTableName() 
    {
        return static::$tableName;
    }

}