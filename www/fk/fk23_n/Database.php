<?php

class Database
{
    private static string $dbName = "db_luftqualitaet";
    private static string $dbHost = "mysql";
    private static string $user = "root";
    private static string $userpasswd = "123";
    private ?PDO $conn;

    private function __construct() {
        $this->conn = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$user, self::$userpasswd);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private static ?Database $INSTANCE = null;

    public static function connect(): ?PDO {
        if (self::$INSTANCE == null) {
            self::$INSTANCE = new Database();
        }
        return self::$INSTANCE->conn;
    }

    public static function disconnect() {
        self::$INSTANCE = null;
    }
}