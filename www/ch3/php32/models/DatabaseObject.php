<?php

require_once 'Database.php';

interface DatabaseObject
{
    /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create(): int;

    /**
     * Update an existing object in the database
     * @return boolean true on success
     */
    public function update(): bool;

    /**
     * Get an object from database
     * @param integer $id
     */
    public static function get(int $id): ?static;

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll(): array;

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete(int $id): void;
}

trait DatabaseObjectCommons {
    private array $errors = [];
    private function validateHelper(string $label, string $key, mixed $value, int $maxLength): bool
    {
        if (strlen($value) == 0) {
            $this->errors[$key] = "$label darf nicht leer sein";
            return false;
        } else if (strlen($value) > $maxLength) {
            $this->errors[$key] = "$label zu lang (max. $maxLength Zeichen)";
            return false;
        } else {
            return true;
        }
    }
}