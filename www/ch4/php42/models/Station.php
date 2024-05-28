<?php

namespace models;

use Exception;
use JsonSerializable;
use PDO;

class Station implements DatabaseObject, JsonSerializable
{
    private int $id;
    private string $name;
    private float $altitude;
    private string $location;

    private array $errors = [];

    public function validate() : bool {
        return $this->validateName() & $this->validateAltitude() & $this->validateLocation();
    }

    /**
     * create or update an object
     * @return boolean true on success
     */
    public function save(): bool
    {
        if ($this->validate()) {
            if ($this->id != null && $this->id > 0) {
                $this->update();
            } else {
                $this->id = $this->create();
            }

            return true;
        }

        return false;
    }

    /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create(): int {
        $db = Database::connect();
        $sql = "INSERT INTO station (name, altitude, location) values(?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->altitude, $this->location));
        $lastId = $db->lastInsertId();
        Database::disconnect();
        return $lastId;
    }

    /**
     * Saves the object to the database
     */
    public function update(): bool {
        $db = Database::connect();
        $sql = "UPDATE station set name = ?, altitude = ?, location = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $ret = $stmt->execute(array($this->name, $this->altitude, $this->location, $this->id));
        Database::disconnect();
        return $ret;
    }

    public static function get(int $id) : ?static {
        $db = Database::connect();
        $sql = "SELECT * FROM station where id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject(static::class);
        Database::disconnect();
        return $item !== false ? $item : null;
    }

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll(): array {
        $db = Database::connect();

        $sql = "SELECT * FROM station ORDER BY name ASC";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        // fetch all datasets (rows), convert to array of Credentials-objects (ORM)
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);

        Database::disconnect();
        return $items;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     * @return bool true on success
     */
    public static function delete($id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM station WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
            return true;    // success
        } catch (Exception $e) {
            Database::disconnect();
            return false;   // error
        }
    }

    private function validateName()
    {
        if ($this->name == '') {
            $this->errors['name'] = "Name darf nicht leer sein";
            return false;
        } else if (strlen($this->name) > 64) {
            $this->errors['name'] = "Name zu lang";
            return false;
        } else {
            unset($this->errors['name']);
            return true;
        }
    }

    private function validateAltitude(): bool {
        if (!is_numeric($this->altitude) || $this->altitude < 0 || $this->altitude > 4000) {
            $this->errors['altitude'] = "Höhe ungültig";
            return false;
        } else {
            unset($this->errors['altitude']);
            return true;
        }
    }

    private function validateLocation(): bool {
        if ($this->location == '') {
            $this->errors['location'] = "Ort darf nicht leer sein";
            return false;
        } else if (strlen($this->location) > 255) {
            $this->errors['location'] = "Ort zu lang";
            return false;
        } else {
            unset($this->errors['location']);
            return true;
        }
    }

    public function hasError($field): bool {
        return !empty($this->errors[$field]);
    }

    /**
     * @return array
     */
    public function getError($field): array {
        return $this->errors[$field];
    }

    public function jsonSerialize(): array {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "altitude" => intval($this->altitude),
            "location" => $this->location,
        ];
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAltitude(): float
    {
        return $this->altitude;
    }

    public function setAltitude($altitude): void
    {
        $this->altitude = $altitude;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation($location): void
    {
        $this->location = $location;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
