<?php

namespace Models;

use Resources\Database\Db;

abstract class ActiveRecord
{
    protected $id;

    public function getId() 
    {
        return $this->id;
    }

    static function findAll() 
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM '.static::getTableName(),[],static::class);
    }

    static function find($id) 
    {
        $db = Db::getInstance();
        $sql =  $db->query('SELECT * FROM '.static::getTableName().' WHERE id=:id', ['id'=> $id] ,static::class);
        return $sql ? $sql[0] : null;
    }

    private function propertiesToDbFormat() 
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $arrProperty = [];
        foreach($properties as $property) {
            $propertyName = $property->getName();
            $arrProperty[$propertyName] = $this->$propertyName;
        }
        return $arrProperty;
    }

    public function save() 
    {
        $properties = $this->propertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($properties);
        } else {
            $this->insert($properties);
        }
    }

    public function update($properties) 
    {
        $sqlParams = [];
        $sqlValues = [];
        $index = 1;
        foreach($properties as $property => $value) {
            $param = ':param' . $index;
            $sqlParams[] = $property. ' = ' . $param;
            $sqlValues[':param' . $index] = $value;
            $index++;
        }

        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $sqlParams). ' WHERE id = ' .$this->id;
        $db = Db::getInstance();
        $db->query($sql,$sqlValues,static::class);

    }

    public function insert($properties) 
    {
        $properties = array_filter($properties);
        $columns = [];
        $sqlParams = [];
        $sqlValues = [];
        foreach ($properties as $property => $value) {
            $columns[] = '`' . $property. '`';
            $paramName = ':' . $property;
            $sqlParams[] = $paramName;
            $sqlValues[$paramName] = $value;
        }

        $sql = 'INSERT INTO ' . static::getTableName() . ' ( ' .implode(',',$columns). ')'. ' VALUES ' .'(' . implode(', ', $sqlParams).')';
        $db = Db::getInstance();
        $db->query($sql,$sqlValues,static::class);
        $this->id = $db->getLastInsertId();
    }

    public function delete($id) 
    {
        $sql = 'DELETE FROM ' .static::getTableName() . ' WHERE id=:id';
        $sqlValues = ['id'=>$id];
        $db = Db::getInstance();
        $db->query($sql,$sqlValues,static::class);
        
    }

    abstract static protected function getTableName();


}