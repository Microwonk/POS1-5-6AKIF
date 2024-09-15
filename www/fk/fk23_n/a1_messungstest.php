<?php

require_once "a1_Messung.php";

$messungen = [
    new BMessung(new DateTime('now'), 12),
    new BMessung(new DateTime('9/15/2024 1:34:00'), 100),
    new BMessung(new DateTime('9/17/2024 1:34:00'), 6),
];

$sum = 0;

foreach ($messungen as $m) {
    var_dump($m);
    echo '<br>';
    echo '<br>';
    $sum += $m->getWert();
}

echo "Durchschnitt aller Messwerte: " . $sum / count($messungen);