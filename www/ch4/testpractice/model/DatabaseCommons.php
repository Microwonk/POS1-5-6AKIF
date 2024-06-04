<?php

namespace model;

use PDO;
use ReflectionClass;

abstract class DatabaseCommons
{
    protected function getValuesProperties() : array {
        $reflection = new ReflectionClass($this);
        $properties = [];
        $values = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $properties[] = $property->getName();
            $values[] = $property->getValue($this);
        }

        return [$properties, $values];
    }

    protected function createHelper(string $tableName) : int {
        $db = Database::get();

        [$properties, $values] = self::getValuesProperties();
        // Prepare placeholders for the SQL statement
        $placeholders = array_fill(0, count($values), '?');

        // Build the SQL query dynamically
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES(%s);",
            $tableName,
            implode(", ", $properties),
            implode(", ", $placeholders)
        );

        // Prepare and execute the statement with the actual values
        $stmt = $db->prepare($sql);
        $stmt->execute($values);
        return $db->lastInsertId();
    }

    protected static function getHelper(string $tableName, int $id, string $idName = "id") : ?static {
        $db = Database::get();

        // Build the SQL query
        $sql = sprintf("SELECT * FROM %s WHERE $idName = ?", $tableName);

        // Prepare and execute the statement
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        // Fetch the result
        $result = $stmt->fetchObject(static::class);
        if (is_bool($result)) {
            return null;
        }
        return $result;
    }

    protected static function deleteHelper(string $tableName, int $id, string $idName = "id") : bool {
        $db = Database::get();

        // Build the SQL query
        $sql = sprintf("DELETE FROM %s WHERE $idName = ?", $tableName);

        // Prepare and execute the statement
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function updateHelper(string $tableName, string $idName) : bool {
        $db = Database::get();

        $reflection = new ReflectionClass($this);
        $properties = [];
        $values = [];

        $id = '';
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($this);

            if ($propertyName !== $idName) {  // Skip the primary key for the update set
                $properties[] = "$propertyName = ?";
                $values[] = $propertyValue;
            } else {
                // The id is used in the WHERE clause
                $id = $propertyValue;
            }
        }

        // Build the SQL query dynamically
        $sql = sprintf(
            "UPDATE %s SET %s WHERE $idName = ?;",
            $tableName,
            implode(", ", $properties)
        );

        $values[] = $id;

        $stmt = $db->prepare($sql);
        return $stmt->execute($values);
    }

    protected static function getAllHelper(string $tableName) : array {
        $db = Database::get();
        $sql = sprintf("SELECT * FROM %s", $tableName);
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }
}