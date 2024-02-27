<?php
$title = "Zimmerverwaltung";
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
                    <th>Zimmernummer</th>
                    <th>Name</th>
                    <th>Personen</th>
                    <th>Preis</th>
                    <th>Balkon</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once "../../models/Room.php";
                foreach (Room::getAll() as $r) {
                    $id = $r->getNr();
                    echo '<tr>';
                    echo '<td>'. $id .'</td>';
                    echo '<td>'. $r->getName() .'</td>';
                    echo '<td>'. $r->getPersonen() .'</td>';
                    echo '<td>€ '. $r->getPreis() .'</td>';
                    echo '<td>'. ($r->hasBalkon() ? 'JA' : 'NEIN') .'</td>';
                    echo '<td><a class="btn btn-info" href="view.php?id='. $id .'"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;<a
                                class="btn btn-primary" href="update.php?id='. $id .'"><span
                                    class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a
                                class="btn btn-danger" href="delete.php?id='. $id .'"><span
                                    class="glyphicon glyphicon-remove"></span></a>
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