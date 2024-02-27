<?php
$title = "Zimmer löschen";
include '../layouts/top.php';

require_once '../../models/Room.php';

if (!isset($_GET['id'])) {
    exit('Keine Id Mitgegeben.');
}

if(isset($_POST['submit'])) {
    Room::delete($_POST['id']);
    header('Location: index.php');
    exit(0);
}

$id = $_GET['id'];

$room = Room::get($id);
$roomNr = $room->getNr();
?>

    <div class="container">
        <h2><?= $title ?></h2>

        <form class="form-horizontal" action="delete.php?id=<?= $roomNr ?>" method="post">
            <input type="hidden" name="id" value="<?= $roomNr ?>"/>
            <p class="alert alert-error">Wollen Sie das Zimmer wirklich löschen?</p>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
                <a class="btn btn-default" href="index.php">Abbruch</a>
            </div>
        </form>

    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>