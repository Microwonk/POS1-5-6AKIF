<?php

namespace model;

use JetBrains\PhpStorm\NoReturn;
use PDO;
use PDOException;

class Database
{
    private static ?Database $INSTANCE = null;
    public static function get() : PDO {
        if (static::$INSTANCE == null) {
            static::$INSTANCE = new static();
        }
        return self::$INSTANCE->conn;
    }
    private static string $dbName = 'orders_db';
    private static string $dbHost = 'mysql';
    private static string $dbUsername = 'root';
    private static string $dbUserPassword = '123';

    private ?PDO $conn = null;

    #[NoReturn] private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function __destruct()
    {
        $this->conn = null;
    }
}
