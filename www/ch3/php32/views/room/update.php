<?php
$title = "Zimmer bearbeiten";
include '../layouts/top.php';

if(isset($_POST['submit'])) {
    // Get the id from the GET parameter
    $pid = $_POST['nr'];

    // Include necessary files and initialize objects
    require_once '../../models/Room.php';
    $room = Room::get($pid);

    // Update the room object with form data
    $room->setName($_POST['name']);
    $room->setPreis($_POST['price']);
    $room->setBalkon(isset($_POST['balcony']));
    $room->setPersonen($_POST['size']);

    // Perform the update operation
    if($room->update()) {
        header("Location: index.php");
        exit(0);
    } else {
        foreach ($room->getErrors() as $error) {
            echo "<div class='alert-danger'>$error</div>";
        }
    }
}

if (!isset($_GET['id'])) {
    exit('Keine Id Mitgegeben.');
}

$id = $_GET['id'];

require_once '../../models/Room.php';
$room = Room::get($id)
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="update.php?id=<?= $id ?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label for="nr" class="control-label">Zimmernummer *</label>
                    <input type="text" class="form-control" id="nr" name="nr" maxlength="4" value="<?= $room->getNr() ?>">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label for="name" class="control-label">Name *</label>
                    <input id="name" type="text" class="form-control" name="name" maxlength="64" value="<?= $room->getName() ?>">
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label for="size" class="control-label">Personen *</label>
                    <input id="size" type="number" class="form-control" name="size" min="1" value="<?= $room->getPersonen() ?>">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label for="price" class="control-label">Preis *</label>
                    <input id="price" type="text" class="form-control" name="price" value="<?= $room->getPreis() ?>">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <div class="form-group required ">
                    <label for="balcony" class="control-label">Balkon *</label>
                    <input id="balcony" type="checkbox" class="form-control" name="balcony" checked="<?= $room->hasBalkon() ?>">
                </div>
            </div>
            <div class="col-md-5"></div>
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
