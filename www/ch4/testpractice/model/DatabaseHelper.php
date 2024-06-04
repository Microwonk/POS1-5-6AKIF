<?php

namespace model;
class DatabaseHelper {
    public static function create(DatabaseObject $dbObject, string $tableName) : int {
        $db = Database::get();

        // Extract properties and values from the object

        $properties = array_map(function ($k) use ($tableName, $dbObject) {
            $className = explode('\\', get_class($dbObject));
            $array = explode(end($className), $k);
            return end($array);
        }, array_keys(get_mangled_object_vars($dbObject)));
        $values = array_values(get_mangled_object_vars($dbObject));

        // Prepare placeholders for the SQL statement
        $placeholders = array_fill(0, count($values), '?');

        // Build the SQL query dynamically
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $tableName,
            implode(", ", $properties),
            implode(", ", $placeholders)
        );

        print_r($sql);

        $stmt = $db->prepare($sql);
        $stmt->execute($values);
        return $db->lastInsertId();
    }
}