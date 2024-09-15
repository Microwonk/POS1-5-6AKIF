<?php
    require_once "BMessung.php";
?>

<head>
    <link rel="stylesheet" href="bootstrap.min.css"/>
</head>
<h1 class="text-center m-5">Alle Messwerte</h1>
<div class="p-5">
    <table class="table-striped table table-bordered table-hover">
        <thead>
        <tr>
            <th>
                Zeitpunkt
            </th>
            <th>
                Messwert
            </th>
            <th>
                Station
            </th>
        </tr>
        </thead>
        <?php

        foreach (BMessung::getAll() as $m) {
            echo '<tr>';
            echo '<td>' . $m->getMZeitpunkt() . '</td>';
            echo '<td>' . $m->getMMesswert() . '</td>';
            echo '<td>' . $m->getStation()->getSBezeichnung() . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

