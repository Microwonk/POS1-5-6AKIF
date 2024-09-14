<?php

class Database
{
    private static string $dbName = 'application_database';
    private static string $dbHost = 'mysql';
    private static string $dbUsername = 'root';
    private static string $dbUserPassword = '123';

    public ?PDO $conn;

    private function __construct(PDO $conn)
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn = $conn;
    }

    private static ?Database $CONNECTION = null;

    public static function get(): ?PDO
    {
        if (self::$CONNECTION == null) {
            try {
                self::$CONNECTION = new Database(new PDO("mysql:host=" . self::$dbHost . ";port=3306;" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword));
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$CONNECTION->conn;
    }

    public static function disconnect() {
        self::$CONNECTION = null;
    }
}

?>
