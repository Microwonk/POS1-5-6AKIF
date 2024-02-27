<?php
$title = "Gast erstellen";
include '../layouts/top.php';

require_once '../../models/Guest.php';
if(isset($_POST['submit'])) {
    $guest = new Guest();

    $guest->setName($_POST['name']);
    $guest->setEmail($_POST['email']);
    $guest->setAddress($_POST['address']);

    if($guest->create()) {
        header("Location: index.php");
        exit(0);
    } else {
        echo "<div class='alert-danger'>Failed to create guest.</div>";
    }
}
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="create.php" method="post">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="64" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label">Email *</label>
                    <input type="email" class="form-control" name="email" maxlength="128" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label">Adresse *</label>
                    <input type="text" class="form-control" name="address" maxlength="256" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
