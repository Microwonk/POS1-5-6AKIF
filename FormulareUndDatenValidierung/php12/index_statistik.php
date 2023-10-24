<h1 class="mt-3">Statistik</h1>
<table class="table">
    <thead>
    <tr>
        <th>Datum</th>
        <th>Name</th>
        <th>BMI</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require_once("lib/db.func.inc.php");
    $data = getAll();
    foreach ($data as $d) {
        echo "<tr>";
        echo "<td>" . date("d.m.Y", strtotime($d['date'])) . "</td>";
        echo "<td>" . $d['name'] . "</td>";
        echo "<td>" . number_format($d['bmi'], 1) . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
