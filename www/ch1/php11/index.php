<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script type="text/javascript" src="js/index.js"></script>
    <title>Notenerfassung</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Notenerfassung</h1>

        <?php
        // Alternative zu var_dump()
        //print_r($_POST);

        // Einbinden/Laden der Validierungsfunktionen
        // require vs include: bei include funktioniert das Skript auch ohne die gesuchte Datei
        require "lib/func.inc.php";

        $name = '';
        $email = '';
        $subject = '';
        $grade = '';
        $examDate = '';

        // Formularverarbeitung (HTTP POST Request)
        if (isset($_POST['submit'])) {

            // double-check: zuerst pruefen ob die Daten im Request enthalten sein, dann auslesen
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
            $grade = isset($_POST['grade']) ? $_POST['grade'] : '';
            $examDate = isset($_POST['examDate']) ? $_POST['examDate'] : '';

            // Validierung der Daten und Ausgabe des Ergebnisses (an der aktuellen Stelle in der HTML-Seite)
            if (validate($name, $email, $examDate, $subject, $grade)) {
                echo "<p class='alert alert-success'>Die eingegebenen Daten sind in Ordnung!</p>";
            } else {
                echo "<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";
                foreach ($errors as $key => $value) {
                    echo "<li>" . $value . "</li>";
                }
                echo "</ul></div>";
            }
        }

        ?>

        <form id="form_grade" action="index.php" method="post">

            <div class="row">

                <div class="col-sm-6 form-group">
                    <label for="name">Name*</label>
                    <input type="text" 
                           name="name" 
                           class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                           maxlength="20" value="<?= htmlspecialchars($name) ?>" 
                           required 
                    />
                </div>

                <div class="col-sm-6 form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($email) ?>" />
                </div>

            </div>

            <div class="row">

                <div class="col-sm-4 form-group">
                    <label for="subject">Fach*</label>
                    <select name="subject" class="form-select <?= isset($errors['subject']) ? 'is-invalid' : '' ?>" required>
                        <option value="" hidden>- Fach auswählen -</option>
                        <option value="m" <?php if ($subject == "m") echo "selected"; ?>>Mathematik</option>
                        <option value="d" <?php if ($subject == "d") echo "selected"; ?>>Deutsch</option>
                        <option value="e" <?php if ($subject == "e") echo "selected"; ?>>Englisch</option>
                    </select>
                </div>

                <div class="col-sm-4 form-group">
                    <label for="grade">Note*</label>
                    <input type="number" name="grade" class="form-control <?= isset($errors['grade']) ? 'is-invalid' : '' ?>" min="1" max="5" value="<?= htmlspecialchars($grade) ?>" required />
                </div>

                <div class="col-sm-4 form-group">
                    <label for="examDate">Prüfungsdatum*</label>
                    <input type="date" name="examDate" class="form-control <?= isset($errors['examDate']) ? 'is-invalid' : '' ?>" onchange="validateExamDate(this)" value="<?= htmlspecialchars($examDate) ?>" required />
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-sm-3 mb-3 d-grid gap-2">
                    <input type="submit" name="submit" class="btn btn-primary" value="Validieren" />
                </div>

                <div class="col-sm-3 mb-3 d-grid gap-2">
                    <a href="index.php" class="btn btn-secondary">Löschen</a>
                </div>

            </div>

        </form>

    </div>

</body>

</html>