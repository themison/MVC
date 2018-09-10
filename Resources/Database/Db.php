<?php

namespace Resources\Database;

class Db
{

    private $pdo;

    protected static $_instance;

    public function __construct()
    {   
        $option = include __DIR__.'/settings.php';
        $option = $option['db'];
        $this->pdo = new \PDO(
            "mysql:host=$option[host];dbname=$option[dbname]",
            $option['login'],
            $option['password']
         );
         $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $str, array $params = [], $className='stdClass' ) 
    {
        $sth = $this->pdo->prepare($str);
        $result = $sth->execute($params);
        return $sth->fetchAll(\PDO::FETCH_CLASS,$className);
    }

    public function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}