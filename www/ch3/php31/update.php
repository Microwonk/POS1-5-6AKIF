<?php

require_once('models/Credentials.php');

// load single item (per ID), redirect to index if no ID is present (HTTP GET-parameter)
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

if (!empty($_POST)) {
    $c->setName(isset($_POST['name']) ? $_POST['name'] : '');
    $c->setDomain(isset($_POST['domain']) ?$_POST['domain'] : '');
    $c->setCmsUsername(isset($_POST['cms_username']) ? $_POST['cms_username'] : '');
    $c->setCmsPassword(isset($_POST['cms_password']) ? $_POST['cms_password'] : '');

    // update existing item and redirec to index-page
    if ($c->save()) {
        header("Location: view.php?id=" . $c->getId());
        exit();
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
    <div class="row">
        <h2>Zugangsdaten bearbeiten</h2>
    </div>

    <form class="form-horizontal" action="update.php?id=<?= $c->getId() ?>" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['name']) ? 'has-error' : ''; ?>">
                    <label for="name" class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="32"
                           value="<?= $c->getName() ?>">

                    <?php if (!empty($c->getErrors()['name'])): ?>
                        <div class="help-block"><?= $c->getErrors()['name'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['domain']) ? 'has-error' : ''; ?>">
                    <label for="domain" class="control-label">Domäne *</label>
                    <input type="text" class="form-control" name="domain" maxlength="128"
                           value="<?= $c->getDomain() ?>">

                    <?php if (!empty($c->getErrors()['domain'])): ?>
                        <div class="help-block"><?= $c->getErrors()['domain'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['cms_username']) ? 'has-error' : ''; ?>">
                    <label for="cms_username" class="control-label">CMS-Benutzername *</label>
                    <input type="text" class="form-control" name="cms_username" maxlength="64"
                           value="<?= $c->getCmsUsername() ?>">

                    <?php if (!empty($c->getErrors()['cms_username'])): ?>
                        <div class="help-block"><?= $c->getErrors()['cms_username'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['cms_password']) ? 'has-error' : ''; ?>">
                    <label for="cms_password" class="control-label">CMS-Passwort *</label>
                    <input type="text" class="form-control" name="cms_password" maxlength="64"
                           value="<?= $c->getCmsPassword() ?>">

                    <?php if (!empty($c->getErrors()['cms_password'])): ?>
                        <div class="help-block"><?= $c->getErrors()['cms_password'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>
