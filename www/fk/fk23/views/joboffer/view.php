<div class="container">
    <h2>Stellenausschreibung anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="index.php?r=joboffer/update&id=<?= $model->getId() ?>">Aktualisieren</a>
        <a class="btn btn-danger" href="index.php?r=joboffer/delete&id=<?= $model->getId() ?>">Löschen</a>
        <a class="btn btn-default" href="index.php?r=joboffer/index">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
            <tr>
                <th>Titel</th>
                <td><?= $model->getTitle() ?></td>
            </tr>
            <tr>
                <th>Beschreibung</th>
                <td><?= $model->getDescription() ?></td>
            </tr>
            <tr>
                <th>Anforderungen</th>
                <td><?= $model->getRequirements() ?></td>
            </tr>
            <tr>
                <th>Gehalt</th>
                <td><?= $model->getSalary() ?></td>
            </tr>
            <tr>
                <th>Standort</th>
                <td><?= $model->getLocation() ?></td>
            </tr>
            <tr>
                <th>Ausschreibungsdatum</th>
                <td><?= $model->getPostingDate() ?></td>
            </tr>
        </tbody>
    </table>
</div> <!-- /container -->
