<?php

$dbName = 'php12';
$dbHost = 'localhost';
$dbUsername = 'root';
$dbUserPassword = '';

/**
 * Verbindung zur DB aufbauen
 * @return PDO (Verbindungsobjekt)
 */
function connect() {
    global $dbName, $dbHost, $dbUsername, $dbUserPassword;
    try {
        $conn = new PDO("mysql:host=" . $dbHost . ";" . "dbname=" . $dbName, $dbUsername, $dbUserPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

/**
 * Datensatz speichern
 * @param $name
 * @param $date
 * @param $bmi
 */
function save($name, $date, $bmi)
{
    $db = connect();
    $sql = "INSERT INTO bmi (name, date, bmi) values(?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($name, $date, $bmi));
}

/**
 * Auslesen aller Daten (als assoziatives Array)
 * @return array
 */
function getAll()
{
    $db = connect();
    $sql = 'SELECT * FROM bmi ORDER BY name ASC, date ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

?>