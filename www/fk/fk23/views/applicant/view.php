<div class="container">
    <h2>Bewerber:in anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="index.php?r=applicant/update&id=<?= $model->getId() ?>">Aktualisieren</a>
        <a class="btn btn-danger" href="index.php?r=applicant/delete&id=<?= $model->getId() ?>">Löschen</a>
        <a class="btn btn-default" href="index.php?r=applicant/filter">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
            <tr>
                <th>Vorname</th>
                <td><?= $model->getFirstName() ?></td>
            </tr>
            <tr>
                <th>Nachname</th>
                <td><?= $model->getLastName() ?></td>
            </tr>
            <tr>
                <th>E-Mail</th>
                <td><?= $model->getEmail() ?></td>
            </tr>
            <tr>
                <th>Telefon</th>
                <td><?= $model->getPhone() ?></td>
            </tr>
            <tr>
                <th>Bewerbungsdatum</th>
                <td><?= $model->getApplicationDate() ?></td>
            </tr>
            <tr>
                <th>Kandidat für Stellenbewerbung</th>
                <td><?= $model->getJobOffer()->getTitle() ?></td>
            </tr>
        </tbody>
    </table>
</div> <!-- /container -->
