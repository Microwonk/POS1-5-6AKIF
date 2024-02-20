<?php

require_once('models/Credentials.php');

// get ID of item (HTTP GET) for showing
$id = !empty($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

if (!empty($_POST['id'])) {

    if (!is_numeric($_POST['id'])) {
        http_response_code(400);
        die();
    }

    Credentials::delete($_POST['id']);

    header("Location: index.php");
	exit();

} else {
    $c = Credentials::get($id); // load item for showing

    // check if item could be found
    if ($c == null) {
        http_response_code(404);    // item not found
        die();
    }
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
    <h2>Zugangsdaten löschen</h2>

    <form class="form-horizontal" action="delete.php?getId()=<?= $c->getId() ?>" method="post">
        <input type="hidden" name="id" value="<?= $c->getId() ?>"/>
        <p class="alert alert-error">Wollen Sie die Zugangsdaten von <?= $c->getName() . " / " . $c->getDomain() ?> wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>
