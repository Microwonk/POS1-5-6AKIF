<?php
$title = "Gast löschen";
include '../layouts/top.php';

require_once '../../models/Guest.php';

if (!isset($_GET['id'])) {
    exit('Keine Id Mitgegeben.');
}

if(isset($_POST['submit'])) {
    Guest::delete($_POST['id']);
    header('Location: index.php');
    exit(0);
}

$id = $_GET['id'];

$guest = Guest::get($id);
$guestId = $guest->getId();
?>

    <div class="container">
        <h2><?= $title ?></h2>

        <form class="form-horizontal" action="delete.php?id=<?= $guestId ?>" method="post">
            <input type="hidden" name="id" value="<?= $guestId ?>"/>
            <p class="alert alert-error">Wollen Sie den Gast wirklich löschen?</p>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
                <a class="btn btn-default" href="index.php">Abbruch</a>
            </div>
        </form>

    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>