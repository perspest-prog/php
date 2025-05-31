<?php

namespace app\config;

use PDO;
use stdClass;

class Db{
    private $connect;
    private static $instance;

    private const DB_HOST = 'localhost';
    private const DB_PORT = '3307';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';
    private const DB_NAME = 'project';

    private function __construct()
    {
        $this->connect = new \PDO("mysql:host=" . self::DB_HOST .
                   
                    ";dbname=" . self::DB_NAME .
                    ";charset=utf8mb4", self::DB_USERNAME, self::DB_PASSWORD);
    }

    public static function getInstance(){
        if (!self::$instance) return self::$instance = new self;
        else return self::$instance;
    }

    public function query($sql, $params = [], $className='stdClass')
    {
        $sth = $this->connect->prepare($sql);
        $result = $sth->execute($params);
        if (!$result) {
            return null;
        }
        return $sth->fetchAll(PDO::FETCH_CLASS, $className);
    }
}