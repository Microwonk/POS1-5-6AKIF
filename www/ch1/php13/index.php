<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/index.js"></script>
    <title>Benutzerdaten</title>
</head>
<body>

<?php 
require_once('lib/db.data.php');

$search;
$data = getAllData();

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $data = getFilteredData($_GET['search']);
    if (empty($data)) {
        echo '<p class="alert alert-danger">Keine User mit dem Filter "'. $search .'" gefunden.</p>';
    }
}

?>

<div class="container">
    <h1 class="mt-5 mb-3">Benutzerdaten anzeigen</h1>

    <form action="detail.php" method="get" >
        <div class="form-group row">
            <label for="search" class="col-md-auto col-form-label">Suche:</label>
            <div class="col-sm-4">
            <input 
                    type="text"
                    name="search" 
                    id="search"
                    class="form-control"
                    placeholder="suche etwas..."
                    value="<?= htmlspecialchars($search ??= '') ?>"
                    required
                />
            </div>
            <div class="col-sm-1 d-grid">
                <button id="submitBtn" class="btn btn-primary">Suchen</button>
            </div>
            <div class="col-sm-1 d-grid">
                <a href="index.php" class="btn btn-secondary">Leeren</a>
            </div>
        </div>
    </form>

    <div class="row">
        <table class="table">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Geburtsdatum</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($data as $d) {
                    echo "<tr>";
                    echo "<td> <a class='text-decoration-none' href='detail.php?id={$d['id']}'> {$d['firstname']} {$d['lastname']}</a></td>";
                    echo "<td> <a class='text-decoration-none text-black' href='mailto:{$d['email']}'> {$d['email']} </a></td>";
                    echo "<td>" . date("d.m.Y", strtotime($d['birthdate'])) . "</td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>

        </table>
    </div>
</div>

</body>
</html>