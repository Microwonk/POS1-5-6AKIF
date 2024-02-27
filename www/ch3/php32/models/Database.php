<?php

class Database
{
    private static string $dbName = 'php32';
    private static string $dbHost = 'mysql';
    private static string $dbUsername = 'root';
    private static string $dbUserPassword = '123';

    private static ?PDO $conn = null;

    private function __construct() {
        exit('Init function is not allowed');
    }

    public static function connect() : PDO {
        // One connection through whole application
        if (is_null(self::$conn)) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conn;
    }

    public static function disconnect(): void
    {
        self::$conn = null;
    }
}