<?php

require_once "a1_Messung.php";
require_once "a1_Station.php";

$station = new Station();

$messungen = [
    new Messung(new DateTime('now'), 12),
    new Messung(new DateTime('9/15/2024 1:34:00'), 100),
    new Messung(new DateTime('9/17/2024 1:34:00'), 3),
    new Messung(new DateTime('9/18/2024 1:34:00'), 6),
    new Messung(new DateTime('9/21/2024 1:34:00'), 17),
];
foreach ($messungen as $m) {
    $station->hinzufuegen($m);
}

echo "Durchschnitt: " . $station->berechneDurchschnitt();