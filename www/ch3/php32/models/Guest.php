<?php

require_once 'DatabaseObject.php';

class Guest implements DatabaseObject {
    private int $id;
    private string $name;
    private string $email;
    private string $address;

    // trait usage
    use DatabaseObjectCommons;

    private function validate(): bool {
        return $this->validateHelper('Name', 'name', $this->name, 32)
            & $this->validateHelper('Email', 'email', $this->email, 128)
            & $this->validateHelper('Adresse', 'address', $this->address, 256);
    }

    public function save(): bool {
        if ($this->validate()) {
            if ($this->id != null && $this->id > 0) {
                // known ID > 0 -> old object -> update
                $this->update();
            } else {
                // undefined ID -> new object -> create
                $this->id = $this->create();
            }
            return true;
        }
        return false;
    }

    public function create(): int {
        $db = Database::connect();
        $sql = "INSERT INTO guests (name, address, email) values(?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->name, $this->address, $this->email]);
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();
        return $lastId;
    }

    public function update(): bool {
        $db = Database::connect();
        $sql = "UPDATE guests set name = ?, address = ?, email = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([$this->name, $this->address, $this->email, $this->id]);
        Database::disconnect();
        return $success;
    }

    public static function get(int $id): ?static {
        $db = Database::connect();
        $sql = "SELECT * FROM guests WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $item = $stmt->fetchObject(static::class);
        Database::disconnect();

        return $item !== false ? $item : null;
    }

    public static function getAll(): array {
        $db = Database::connect();
        $sql = 'SELECT * FROM guests';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // fetch all datasets (rows), convert to array of Credentials-objects (ORM)
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        Database::disconnect();

        return $items;
    }

    public static function delete(int $id): void {
        $db = Database::connect();
        $sql = "DELETE FROM guests WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }

    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getAddress() : string {
        return $this->address;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }
}