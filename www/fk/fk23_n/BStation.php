<?php

require_once "DatabaseObject.php";
require_once "Database.php";
class BStation implements DatabaseObject
{
    private int $s_id;
    private string $s_bezeichnung;

    public function insert()
    {
        // TODO: Implement insert() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public static function get($id)
    {
        // TODO: Implement get() method.
    }

    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM stationen");
        $stmt->execute();
        Database::disconnect();
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getSId(): int
    {
        return $this->s_id;
    }

    public function setSId(int $s_id): void
    {
        $this->s_id = $s_id;
    }

    public function getSBezeichnung(): string
    {
        return $this->s_bezeichnung;
    }

    public function setSBezeichnung(string $s_bezeichnung): void
    {
        $this->s_bezeichnung = $s_bezeichnung;
    }
}