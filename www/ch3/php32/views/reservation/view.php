<?php
$title = "Reservierungsdetails";
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

// Fetch the guest associated with the reservation
$guest = Guest::get($reservation->getGuestId());

// Fetch the room associated with the reservation
$room = Room::get($reservation->getRoomNr());

// Calculate the total price for the reservation
$totalPrice = $room->getPreis() * $reservation->getDurationInDays();

// Generate calendar view for reservation period
$calendarStart = $reservation->fromAsDate()->format('Y-m-d');
$calendarEnd = $reservation->toAsDate()->format('Y-m-d');

// Output the calendar HTML (replace with your preferred calendar implementation)
$calendarHTML = "<p>TODO</p>"; // Replace with actual calendar HTML

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?= $title ?></h2>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Reservierungs Details</h3>
                    <p class="card-text"><strong>Von:</strong> <?= $reservation->fromAsDate()->format('Y-m-d') ?></p>
                    <p class="card-text"><strong>Bis:</strong> <?= $reservation->toAsDate()->format('Y-m-d') ?></p>
                    <p class="card-text"><strong>Gesamtpreis:</strong> €<?= $totalPrice ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Kalenderansicht</h2>
            <div class="card">
                <div class="card-body">
                    <?= $calendarHTML ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h2>Hauptgast Details</h2>
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><strong>Name:</strong> <?= $guest->getName() ?></p>
                    <p class="card-text"><strong>Email:</strong> <?= $guest->getEmail() ?></p>
                    <p class="card-text"><strong>Adresse:</strong> <?= $guest->getAddress() ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Zimmer Details</h2>
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><strong>Zimmernummer:</strong> <?= $room->getNr() ?></p>
                    <p class="card-text"><strong>Name:</strong> <?= $room->getName() ?></p>
                    <p class="card-text"><strong>Preis:</strong> € <?= $room->getPreis() ?></p>
                    <p class="card-text"><strong>Balkon:</strong> <?= $room->hasBalkon() ? 'JA' : 'NEIN' ?></p>
                    <p class="card-text"><strong>Personen:</strong> <?= $room->getPersonen() ?> personen</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/bottom.php'; ?>
