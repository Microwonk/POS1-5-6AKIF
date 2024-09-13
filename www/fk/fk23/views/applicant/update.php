<?php

$jobOffers = $model['joboffers'];
$model = $model['model'];

?>

<div class="container">
    <div class="row">
        <h2>Bewerber:in bearbeiten</h2>
    </div>

    <form class="form-horizontal" action="index.php?r=applicant/update&id=<?= $model->getId() ?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('first_name') ? 'has-error' : ''; ?>">
                    <label class="control-label">Vorname *</label>
                    <input type="text" class="form-control" name="first_name" value="<?= $model->getFirstName() ?>">

                    <?php if (!empty($model->errors['first_name'])) : ?>
                        <div class="help-block"><?= $model->getError('first_name') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('last_name') ? 'has-error' : ''; ?>">
                    <label class="control-label">Nachname *</label>
                    <input type="text" class="form-control" name="last_name" value="<?= $model->getLastName() ?>">

                    <?php if (!empty($model->errors['last_name'])) : ?>
                        <div class="help-block"><?= $model->getError('last_name') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('email') ? 'has-error' : ''; ?>">
                    <label class="control-label">E-Mail *</label>
                    <input type="text" class="form-control" name="email" value="<?= $model->getEmail() ?>">

                    <?php if (!empty($model->errors['email'])) : ?>
                        <div class="help-block"><?= $model->getError('email') ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('phone') ? 'has-error' : ''; ?>">
                    <label class="control-label">Telefon *</label>
                    <input type="text" class="form-control" name="phone" value="<?= $model->getPhone() ?>">

                    <?php if (!empty($model->errors['phone'])) : ?>
                        <div class="help-block"><?= $model->getError('phone') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('application_date') ? 'has-error' : ''; ?>">
                    <label class="control-label">Bewerbungsdatum *</label>
                    <input type="text" class="form-control" name="application_date" value="<?= $model->getApplicationDate() ?>">

                    <?php if (!empty($model->errors['application_date'])) : ?>
                        <div class="help-block"><?= $model->getError('application_date') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('jobOffer_id') ? 'has-error' : ''; ?>">
                    <label class="control-label">Stellenbewerbung *</label>
                    <select class="form-control" name="jobOffer_id" style="width: 200px">
                        <?php
                        foreach ($jobOffers as $jobOffer) :
                            echo '<option ' . ($model->getJobOfferId() == $jobOffer->getId() ? 'selected=selected' : '') . ' value="' . $jobOffer->getId() . '">' . $jobOffer->getTitle() . '</option>';
                        endforeach;
                        ?>
                    </select>
                    <?php if (!empty($model->errors['jobOffer_id'])) : ?>
                        <div class="help-block"><?= $model->getError('jobOffer_id') ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="index.php?r=applicant/view&id=<?= $model->getId() ?>">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->