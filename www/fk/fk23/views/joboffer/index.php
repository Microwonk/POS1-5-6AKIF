<div class="container">
    <div class="row">
        <h2>Stellenausschreibungen</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <a href="index.php?r=joboffer/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Erstellen</a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Titel</th>
                <th>Standort</th>
                <th>Ausschreibungsdatum</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="joboffers">
            <?php
            foreach ($model as $j) {
                echo '<tr>';
                echo '<td>' . $j->getTitle() . '</td>';
                echo '<td>' . $j->getLocation() . '</td>';
                echo '<td>' . $j->getPostingDate() . '</td>';
                echo '<td>';
                echo '<a class="btn btn-info" href="index.php?r=joboffer/view&id=' . $j->getId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-primary" href="index.php?r=joboffer/update&id=' . $j->getId() . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="index.php?r=joboffer/delete&id=' . $j->getId() . '"><span class="glyphicon glyphicon-remove"></span></a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
