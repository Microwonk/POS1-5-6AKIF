<?php

require_once 'Database.php';

interface DatabaseObject {

    public function validate(): bool;
    public function save(): bool;

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

trait DatabaseObjectValidationCommons {
    private array $errors = [];
    private function validateHelperLength(string $label, string $key, mixed $value, int $maxLength): bool {
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

    private function validateHelperNumeric(string $label, string $key, mixed $value, array $minToMax): bool {
        if (!is_numeric($value)) {
            $this->errors[$key] = "$label muss eine Zahl sein";
            return false;
        }
        $min = $minToMax[0];
        $max = $minToMax[1];
        if ($value < $min || $value > $max) {
            $this->errors[$key] = "$label muss zwischen $min und $max liegen";
            return false;
        }
        return true;
    }

    private function validateHelperEmail(string $label, string $key, mixed $value): bool {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$key] = "$label muss eine gültige E-Mail-Adresse sein";
            return false;
        }
        return true;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}