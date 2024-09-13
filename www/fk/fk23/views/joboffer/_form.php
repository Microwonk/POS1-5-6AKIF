<div class="row">
    <div class="col-md-4">
        <div class="form-group required <?= $model->hasError('title') ? 'has-error' : ''; ?>">
            <label class="control-label">Titel *</label>
            <input type="text" class="form-control" name="title" value="<?= $model->getTitle() ?>">

            <?php if ($model->hasError('title')): ?>
                <div class="help-block"><?= $model->getError('title') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('location') ? 'has-error' : ''; ?>">
            <label class="control-label">Standort *</label>
            <input type="text" class="form-control" name="location" value="<?= $model->getLocation() ?>">

            <?php if ($model->hasError('location')): ?>
                <div class="help-block"><?= $model->getError('location') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('posting_date') ? 'has-error' : ''; ?>">
            <label class="control-label">Ausschreibungsdatum *</label>
            <input type="text" class="form-control" name="posting_date" value="<?= $model->getPostingDate() ?>">

            <?php if ($model->hasError('posting_date')): ?>
                <div class="help-block"><?= $model->getError('posting_date') ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group required <?= $model->hasError('description') ? 'has-error' : ''; ?>">
            <label class="control-label">Beschreibung *</label>
            <input type="text" class="form-control" name="description" value="<?= $model->getDescription() ?>">

            <?php if ($model->hasError('description')): ?>
                <div class="help-block"><?= $model->getError('description') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('requirements') ? 'has-error' : ''; ?>">
            <label class="control-label">Anforderungen *</label>
            <input type="text" class="form-control" name="requirements" value="<?= $model->getRequirements() ?>">

            <?php if ($model->hasError('requirements')): ?>
                <div class="help-block"><?= $model->getError('requirements') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('salary') ? 'has-error' : ''; ?>">
            <label class="control-label">Gehalt *</label>
            <input type="text" class="form-control" name="salary" value="<?= $model->getSalary() ?>">

            <?php if ($model->hasError('salary')): ?>
                <div class="help-block"><?= $model->getError('salary') ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
