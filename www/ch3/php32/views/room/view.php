<?php
$title = "Zimmer anzeigen";
include '../layouts/top.php';

if (!isset($_GET['id'])) {
    exit('Keine Id Mitgegeben.');
}

$id = $_GET['id'];

require_once '../../models/Room.php';
$room = Room::get($id)
?>

    <div class="container">
        <h2><?= $title ?></h2>

        <p>
            <a class="btn btn-primary" href="update.php?id=<?= $room->getNr(); ?>">Aktualisieren</a>
            <a class="btn btn-danger" href="delete.php?id=<?= $room->getNr(); ?>">Löschen</a>
            <a class="btn btn-default" href="index.php">Zurück</a>
        </p>

        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>Zimmernummer</th>
                <td><?= $room->getNr(); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $room->getName(); ?></td>
            </tr>
            <tr>
                <th>Personen</th>
                <td><?= $room->getPersonen(); ?></td>
            </tr>
            <tr>
                <th>Preis</th>
                <td>€ <?= $room->getPreis(); ?></td>
            </tr>
            <tr>
                <th>Balkon</th>
                <td><?= $room->hasBalkon() ? 'JA' : 'NEIN'; ?></td>
            </tr>
            </tbody>
        </table>
    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>