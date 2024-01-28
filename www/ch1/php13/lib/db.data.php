<?php

$dbName = 'php13';
$dbHost = 'mysql';
$dbUsername = 'root';
$dbUserPassword = '123';

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
 * Auslesen aller Daten (als assoziatives Array)
 * @return array
 */
function getAllData()
{
    $db = connect();
    $sql = 'SELECT * FROM user ORDER BY lastname, firstname';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/**
 * filter data on firstname, lastname or email
 *
 * @param $filter string
 * @return array
 */
function getFilteredData($filter)
{
    $db = connect();
    $sql = "SELECT * FROM user WHERE firstname LIKE :firstname OR lastname LIKE :lastname OR email LIKE :email ORDER BY lastname, firstname";
    $stmt = $db->prepare($sql);
    $filter = "%$filter%";
    $stmt->bindValue(':firstname', $filter);
    $stmt->bindValue(':lastname', $filter);
    $stmt->bindValue(':email', $filter);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/**
 * filter data based on id
 * @param $id
 * @return array or null
 */
function getDataPerId($id)
{
    $db = connect();
    $sql = 'SELECT * FROM user WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

?>