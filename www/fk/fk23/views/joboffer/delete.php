<?php

$error = '';

if (is_array($model) && key_exists('error', $model)) {
    $error = $model['error'];
    $model = $model['model'];
}

?>

<div class="container">
    <h2>Stellenausschreibung löschen</h2>

    <?php

    if ($error != '') {
        echo '<div class="has-error"><div class="help-block">Fehler beim Löschen der Stellenausschreibung</div></div>';
    }

    ?>

    <form class="form-horizontal" action="index.php?r=joboffer/delete&id=<?= $model->getId() ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $model->getId(); ?>"/>
        <p class="alert alert-error">Wollen Sie die Stellenausschreibung <?= $model->getTitle() ?> wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="index.php?r=joboffer/index">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
