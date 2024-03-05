<?php
$title = "Gast bearbeiten";
include '../layouts/top.php';

if(isset($_POST['submit'])) {
    // Get the id from the GET parameter
    $guestId = $_POST['id'];

    // Include necessary files and initialize objects
    require_once '../../models/Guest.php';
    $guest = Guest::get($guestId);

    // Update the guest object with form data
    $guest->setName($_POST['name']);
    $guest->setEmail($_POST['email']);
    $guest->setAddress($_POST['address']);

    // Perform the update operation
    if($guest->save()) {
        header("Location: index.php");
        exit(0);
    } else {
        foreach ($guest->getErrors() as $error) {
            echo "<div class='alert-danger'>$error</div>";
        }
    }
}

if (!isset($_GET['id'])) {
    exit('Keine ID mitgegeben.');
}

$id = $_GET['id'];

require_once '../../models/Guest.php';
$guest = Guest::get($id)
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="update.php?id=<?= $id ?>" method="post">
        <input type="hidden" name="id" value="<?= $id ?>"/>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="name" class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="64" id="name" value="<?= $guest->getName() ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="email" class="control-label">Email *</label>
                    <input type="email" class="form-control" name="email" maxlength="128" id="email" value="<?= $guest->getEmail() ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="address" class="control-label">Adresse *</label>
                    <input type="text" class="form-control" name="address" maxlength="256" id="address" value="<?= $guest->getAddress() ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
