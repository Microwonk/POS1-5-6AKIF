<?php

use models\Database;
use models\DatabaseObject;

require_once 'DatabaseObject.php';
class Room implements DatabaseObject {
    private int $nr = 0;
    private string $name;
    private float $preis;
    private bool $balkon;
    private int $personen;

    // trait usage
    use DatabaseObjectValidationCommons;

    public function validate(): bool {
        return $this->validateHelperLength('Name', 'name', $this->name, 32)
            & $this->validateHelperNumeric('Preis', 'preis', $this->preis, [0, 9999])
            & $this->validateHelperNumeric('Personen', 'personen', $this->personen, [1, 12]);
    }

    public function save(): bool {
        if ($this->validate()) {
            if ($this->nr != null && $this->nr > 0) {
                // known nr > 0 -> old object -> update
                $this->update();
            } else {
                // undefined nr -> new object -> create
                $this->nr = $this->create();
            }
            return true;
        }
        return false;
    }

    public function create(): int {
        $db = Database::connect();
        $sql = "INSERT INTO rooms (name, preis, balkon, personen) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->name, $this->preis, $this->balkon ? 1 : 0, $this->personen]);
        $lastId = $db->lastInsertId();  // get nr of new database-entry
        Database::disconnect();
        return $lastId;
    }

    public function update(): bool {
        $db = Database::connect();
        $sql = "UPDATE rooms SET name = ?, preis = ?, balkon = ?, personen = ? WHERE nr = ?";
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([$this->name, $this->preis, $this->balkon ? 1 : 0, $this->personen, $this->nr]);
        Database::disconnect();
        return $success;
    }

    public static function get(int $id): ?static {
        $db = Database::connect();
        $sql = "SELECT * FROM rooms WHERE nr = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        // fetch dataset (row) per nr, convert to Room-object (ORM)
        $item = $stmt->fetchObject(static::class);
        Database::disconnect();

        return $item !== false ? $item : null;
    }

    public static function getAll(): array {
        $db = Database::connect();
        $sql = 'SELECT * FROM rooms';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // fetch all datasets (rows), convert to array of Room-objects (ORM)
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        Database::disconnect();

        return $items;
    }

    public static function delete(int $nr): void {
        $db = Database::connect();
        $sql = "DELETE FROM rooms WHERE nr = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$nr]);
        Database::disconnect();
    }

    // Getters and setters
    public function getNr(): int {
        return $this->nr;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPreis(): float {
        return $this->preis;
    }

    public function hasBalkon(): bool {
        return $this->balkon;
    }

    public function getPersonen(): int {
        return $this->personen;
    }

    public function setNr(int $nr): void {
        $this->nr = $nr;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPreis(float $preis): void {
        $this->preis = $preis;
    }

    public function setBalkon(bool $balkon): void {
        $this->balkon = $balkon;
    }

    public function setPersonen(int $personen): void {
        $this->personen = $personen;
    }
}
