<?php
$title = "Reservierungsverwaltung";
include '../layouts/top.php';
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>
    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Von</th>
                <th>Bis</th>
                <th>Zimmernummer</th>
                <th>Gast</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once "../../models/Reservation.php";
            require_once "../../models/Room.php";
            require_once "../../models/Guest.php";

            foreach (Reservation::getAll() as $reservation) {
                $reservationId = $reservation->getId();
                $roomId = $reservation->getRoomNr();
                $guestId = $reservation->getGuestId();

                $room = Room::get($roomId);
                $guest = Guest::get($guestId);

                echo '<tr>';
                echo '<td>' . $reservationId . '</td>';
                echo '<td>' . $reservation->getFrom() . '</td>';
                echo '<td>' . $reservation->getTo() . '</td>';
                echo '<td><a href="../room/view.php?id=' . $roomId . '">' . $roomId . '</a></td>';
                echo '<td><a href="../guest/view.php?id=' . $guestId . '">' . ($guest ? $guest->getName() : 'Unknown Guest') . '</td>';
                echo '<td>
                    <a class="btn btn-info" href="view.php?id=' . $reservationId . '">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a class="btn btn-primary" href="update.php?id=' . $reservationId . '">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class="btn btn-danger" href="delete.php?id=' . $reservationId . '">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
