<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/funcs.js"></script>
    <title>BMI-Rechner</title>
</head>
<body>
<div class="container">
        <h1 class="mt-5 mb-3">Body-Mass-Index-Rechner</h1>

        <?php
        require "lib/func.inc.php";

        define('NAME', 'name');
        define('DATE', 'date');
        define('HEIGHT', 'height');
        define('WEIGHT', 'weight');

        // BMI nums
        define('UNDERWEIGHT', 18.5);
        define('NORMAL', 24.9);
        define('OVERWEIGHT', 29.9);
        define('OBESE', 30.0);

        $name = '';
        $date = '';
        $height = '';
        $weight = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $name = $_POST[NAME] ?? '';
            $date = $_POST[DATE] ?? '';
            $height = $_POST[HEIGHT] ?? '';
            $weight = $_POST[WEIGHT] ?? '';


            if (validate($name, $date, $height, $weight)) {
                list($bmi, $text) = calculateBMI($height, $weight);
                echo "<p class='alert alert-success'>BMI: " . number_format($bmi, 2) . " - " . $text . "</p>";
            } else {
                echo "<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";
                foreach ($errors as $key => $value) {
                    echo "<li>" . $value . "</li>";
                }
                echo "</ul></div>";
            }

        }

        ?>

        <div class="row">

            <form id="form_bmi" action="index.php" method="post" class="col-sm-8">

                <div class="row">

                    <div class="col-sm-8 form-group">
                        <label for="name">Name*</label>
                        <input 
                            name="name" 
                            class="form-control <?= isset($errors[NAME]) ? 'is-invalid' : '' ?>"
                            maxlength="25"
                            value="<?= htmlspecialchars($name) ?>"
                            required />
                    </div>

                    <div class="col-sm-4 form-group">
                        <label for="date">Messdatum*</label>
                        <input 
                            type="date" 
                            name="date" 
                            class="form-control <?= isset($errors[DATE]) ? 'is-invalid' : '' ?>"
                            onchange="validateDate(this)"
                            value="<?= htmlspecialchars($date) ?>"
                            required />
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-5 form-group">
                        <label for="height">Größe (cm)*</label>
                        <input 
                            type="number" 
                            name="height" 
                            min="1"
                            max="1000"
                            class="form-control <?= isset($errors[HEIGHT]) ? 'is-invalid' : '' ?>"
                            value="<?= htmlspecialchars($height) ?>"
                            required />
                    </div>

                    <div class="col-sm-7 form-group">
                        <label for="weight">Gewicht (kg)*</label>
                        <input 
                            type="number" 
                            name="weight" 
                            min="1"
                            max="1000"
                            class="form-control <?= isset($errors[WEIGHT]) ? 'is-invalid' : '' ?>"
                            value="<?= htmlspecialchars($weight) ?>"
                            required />
                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-sm-3 mb-3 d-grid">
                        <input type="submit" name="submit" class="btn btn-primary" value="Speichern" />
                    </div>

                    <div class="col-sm-3 mb-3 d-grid">
                        <a href="index.php" class="btn btn-secondary">Löschen</a>
                    </div>

                </div>

            </form>
            <div class="col-sm-4">
                <div class="row">
                    <h2 class="mb-3">Info zum BMI:</h2>
                    <ul class="list-unstyled">
                        <li>Unter <?=UNDERWEIGHT?> Untergewicht</li>
                        <li><?=UNDERWEIGHT?> - <?=NORMAL?> Normal</li>
                        <li><?=NORMAL?> - <?=OVERWEIGHT?> Übergewicht</li>
                        <li><?=OBESE?> und darüber Adipositas</li>
                    </ul>
                </div>
                    <img src="images/ampel.png" alt="Anzeige des BMI in Ampel-Form" id="ampel">
                </div>

            </div>

        </div>

    </div>

</body>
</html>