<div class="container">

    <div class="row">
        <?php
        session_start();

        require_once "BStation.php";
        require_once "BMessung.php";

        $stations = BStation::getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $s_id = $_POST['s_id'] ?? '';
            $date = $_POST['date'] ?? '';
            $messwert = $_POST['messwert'] ?? '';
            $mw = new BMessung($date, $messwert, $s_id);
            $mw->insert();
        }

        echo '<div class="alert alert-info">Angemeldet als ' . $_SESSION['mail'] . '</div>';
        ?>
    </div>
    <head>
        <link rel="stylesheet" href="bootstrap.min.css"/>
    </head>

    <div class="row text-center p-5">
        <h1>Messung manuell erfassen</h1>
    </div>
    <div class="row">
        <div class="form-group">
            <form method="POST" action="b_formular.php">
                <label for="s_id">Messstation</label>
                <select class="btn btn-light btn-block dropdown-toggle" name="s_id" id="s_id" style="width: 200px">
                    <?php
                    foreach($stations as $s):
                        echo '<option value="' . $s->getSId() . '">' . $s->getSBezeichnung() . '</option>';
                    endforeach;
                    ?>
                </select>
                <div class="form-floating my-3">
                    <input class="form-control" type="date" required name="date" id="date" placeholder="Datum:">
                    <label for="date">Datum:</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="number" required minlength="3" name="messwert" id="messwert" placeholder="Messwert:">
                    <label for="messwert">Messwert:</label>
                </div>
                <button type="submit" class="btn btn-danger btn-block">Speichern</button>
            </form>
        </div>
    </div>
</div>
