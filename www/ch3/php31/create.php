<?php

require_once('models/Credentials.php');

// create new/empty model, contains all input-values and error-messages
$c = new Credentials();

if (!empty($_POST)) {

    $c->setName(isset($_POST['name']) ? $_POST['name'] : '');
    $c->setDomain(isset($_POST['domain']) ?$_POST['domain'] : '');
    $c->setCmsUsername(isset($_POST['cms_username']) ? $_POST['cms_username'] : '');
    $c->setCmsPassword(isset($_POST['cms_password']) ? $_POST['cms_password'] : '');

    // redirect to view-page after successfull saving
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
        <h2>Zugangsdaten erstellen</h2>
    </div>

    <form class="form-horizontal" action="create.php" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['name']) ? 'has-error' : ''; ?>">
                    <label for="name" class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="32" value="<?= $c->getName() ?>">
                    <?php if (!empty($c->getErrors()['name'])): ?>
                        <div class="help-block"><?= $c->getErrors()['name'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['domain']) ? 'has-error' : ''; ?>">
                    <label for="domain" class="control-label">Domäne *</label>
                    <input type="text" class="form-control" name="domain" maxlength="128" value="<?= $c->getDomain() ?>">
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
                    <input type="text" class="form-control" name="cms_username" maxlength="64" value="<?= $c->getCmsUsername() ?>">
                    <?php if (!empty($c->getErrors()['cms_username'])): ?>
                        <div class="help-block"><?= $c->getErrors()['cms_username'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group required <?php echo !empty($c->getErrors()['cms_password']) ? 'has-error' : ''; ?>">
                    <label for="cms_password" class="control-label">CMS-Passwort *</label>
                    <input type="text" class="form-control" name="cms_password" maxlength="64" value="<?= $c->getCmsPassword() ?>">
                    <?php if (!empty($c->getErrors()['cms_password'])): ?>
                        <div class="help-block"><?= $c->getErrors()['cms_password'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>
