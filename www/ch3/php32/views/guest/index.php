<?php
$title = "Gastverwaltung";
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
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Adresse</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once "../../models/Guest.php";

            foreach (Guest::getAll() as $guest) {
                $guestId = $guest->getId();

                echo '<tr>';
                echo '<td>' . $guestId . '</td>';
                echo '<td>' . $guest->getName() . '</td>';
                echo '<td>' . $guest->getEmail() . '</td>';
                echo '<td>' . $guest->getAddress() . '</td>';
                echo '<td>
                    <a class="btn btn-info" href="view.php?id=' . $guestId . '">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a class="btn btn-primary" href="update.php?id=' . $guestId . '">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class="btn btn-danger" href="delete.php?id=' . $guestId . '">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
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
