<?php
$title = "Gast anzeigen";
include '../layouts/top.php';

if (!isset($_GET['id'])) {
    exit('Keine ID mitgegeben.');
}

$id = $_GET['id'];

require_once '../../models/Guest.php';
$guest = Guest::get($id)
?>

<div class="container">
    <h2><?= $title ?></h2>

    <p>
        <a class="btn btn-primary" href="update.php?id=<?= $guest->getId(); ?>">Aktualisieren</a>
        <a class="btn btn-danger" href="delete.php?id=<?= $guest->getId(); ?>">Löschen</a>
        <a class="btn btn-default" href="index.php">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>ID</th>
            <td><?= $guest->getId(); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?= $guest->getName(); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $guest->getEmail(); ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?= $guest->getAddress(); ?></td>
        </tr>
        </tbody>
    </table>
</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
