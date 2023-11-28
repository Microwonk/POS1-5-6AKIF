<?php
// Starten der PHP Session (muss der erste ausgeführte/ausgegebene Befehl sein)
// es darf vorher keine Ausgabe z.B. echo oder HTML-Code sein
session_start();

if (isset($_POST['clear'])) {

    require_once "models/GradeEntry.php";
    GradeEntry::deleteAll();

    header("Location: index.php");    // redirect user to index.php page
} else {
    http_response_code(405);    // unallowed method (only HTTP POST allowed)
}

?>
