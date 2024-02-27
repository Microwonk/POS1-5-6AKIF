<?php
$title = "Reservierung erstellen";
include '../layouts/top.php';

require_once '../../models/Reservation.php';
require_once '../../models/Room.php';
require_once '../../models/Guest.php';

if(isset($_POST['submit'])) {
    $reservation = new Reservation();

    // Convert date strings to DateTime objects
    $from = $_POST['from'];
    $to = $_POST['to'];
    $reservation->setFrom($from);
    $reservation->setTo($to);

    // Retrieve Room object
    $roomId = (int)$_POST['room_id'];
    $room = Room::get($roomId);
    if (!is_null($room)) {
        $reservation->setRoom($room);
    }

    // Retrieve Guest object
    $guestId = (int)$_POST['guest_id'];
    $guest = Guest::get($guestId);
    if (!is_null($guest)) {
        $reservation->setGuest($guest);
    }

    if($reservation->create()) {
        header("Location: index.php");
        exit(0);
    } else {
        echo "<div class='alert-danger'>Failed to create reservation.</div>";
    }
}

$rooms = Room::getAll();
$guests = Guest::getAll();
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="create.php" method="post">

        <div class="form-group">
            <label class="control-label">Von *</label>
            <input type="date" class="form-control" name="from" required>
        </div>

        <div class="form-group">
            <label class="control-label">Bis *</label>
            <input type="date" class="form-control" name="to" required>
        </div>

        <div class="form-group">
            <label class="control-label">Zimmer *</label>
            <select class="form-control" name="room_id" required>
                <option value="">Bitte wählen</option>
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= $room->getNr(); ?>"><?= $room->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">Gast *</label>
            <select class="form-control" name="guest_id" required>
                <option value="">Bitte wählen</option>
                <?php foreach ($guests as $guest): ?>
                    <option value="<?= $guest->getId(); ?>"><?= $guest->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>
</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
