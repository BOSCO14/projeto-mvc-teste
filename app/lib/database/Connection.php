<?php

namespace app\lib\database;

abstract class Connection{

    private static $host = 'localhost';
    private static $username = 'root';
    private static $password = 'jb141081';
    private static $dbname = 'login_db';
    private static $conn;

    public static function getConn(){
    
            try {
                self::$conn = new \PDO('mysql:host='.self::$host.';dbname='.self::$dbname.'',self::$username,self::$password);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$conn->exec('set names utf8');
                return self::$conn;
            } catch (\PDOException $e) {
                echo "Connection error: " . $e->getMessage();
            }
    }

}