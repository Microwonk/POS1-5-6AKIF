<?php
$title = "Reservation aktualisieren";
include '../layouts/top.php';

// Ensure that an ID is provided via GET parameter
if (!isset($_GET['id'])) {
    exit('Keine ID übergeben.');
}

$id = $_GET['id'];

// Fetch the reservation data based on the provided ID
require_once '../../models/Reservation.php';
require_once '../../models/Guest.php';
require_once '../../models/Room.php';
$reservation = Reservation::get($id);

// Check if the reservation exists
if (!$reservation) {
    exit('Reservation nicht gefunden.');
}

$rooms = Room::getAll();
$guests = Guest::getAll();

if (isset($_POST['submit'])) {
    // Update the reservation object with form data
    $reservation->setFrom($_POST['from']);
    $reservation->setTo($_POST['to']);
    $reservation->setRoomNr($_POST['room_id']);
    $reservation->setGuestId($_POST['guest_id']);

    // Perform the update operation
    if ($reservation->save()) {
        header("Location: index.php");
        exit(0);
    } else {
        foreach ($reservation->getErrors() as $error) {
            echo "<div class='alert-danger'>$error</div>";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="update.php?id=<?= $id ?>" method="post">

        <div class="form-group">
            <label class="control-label">Von *</label>
            <input type="date" class="form-control" name="from" value="<?= $reservation->fromAsDate()->format('Y-m-d') ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label">Bis *</label>
            <input type="date" class="form-control" name="to" value="<?= $reservation->toAsDate()->format('Y-m-d') ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label">Zimmer *</label>
            <select class="form-control" name="room_id" required>
                <!-- Populate room options dynamically -->
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= $room->getNr() ?>" <?= ($room->getNr() == $reservation->getRoomNr()) ? 'selected' : '' ?>><?= $room->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">Gast *</label>
            <select class="form-control" name="guest_id" required>
                <!-- Populate guest options dynamically -->
                <?php foreach ($guests as $guest): ?>
                    <option value="<?= $guest->getId() ?>" <?= ($guest->getId() == $reservation->getGuestId()) ? 'selected' : '' ?>><?= $guest->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="index.php">Abbrechen</a>
        </div>
    </form>
</div>

<?php include '../layouts/bottom.php'; ?>
