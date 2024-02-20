<?php

require_once('models/Credentials.php');

// view single item (per ID), redirect to index if no ID is present (HTTP GET-parameter)
if (empty($_GET['id'])) {
    header("Location: index.php");
	exit();
} else if (!is_numeric($_GET['id'])) {
    http_response_code(400);
    die();
} else {
    // load single item per ID
    $c = Credentials::get($_GET['id']);
}

// check if item could be found
if ($c == null) {
    http_response_code(404);    // item not found
    die();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Passwortmanager</title>

    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="css/favicon.ico" type="image/x-icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Zugangsdaten anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="update.php?id=<?= $c->getId() ?>">Aktualisieren</a>
        <a class="btn btn-danger" href="delete.php?id=<?= $c->getId() ?>">Löschen</a>
        <a class="btn btn-default" href="index.php">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Name</th>
            <td><?= $c->getName() ?></td>
        </tr>
        <tr>
            <th>Domäne</th>
            <td><?= $c->getDomain() ?></td>
        </tr>
        <tr>
            <th>CMS-Benutzername</th>
            <td><?= $c->getCmsUsername() ?></td>
        </tr>
        <tr>
            <th>CMS-Passwort</th>
            <td><?= $c->getCmsPassword() ?></td>
        </tr>
        </tbody>
    </table>
</div> <!-- /container -->
</body>
</html>
