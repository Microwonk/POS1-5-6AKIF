<div class="container">
    <h2>Bewerber:in löschen</h2>

    <form class="form-horizontal" action="index.php?r=applicant/delete&id=<?= $model->getId() ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $model->getId(); ?>"/>
        <p class="alert alert-error">Wollen Sie den Bewerber <?= $model->getFirstName() . " " . $model->getLastName() ?> (für <?= $model->getJobOffer()->getTitle() ?>) wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="index.php?r=applicant/view&id=<?= $model->getId() ?>">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
