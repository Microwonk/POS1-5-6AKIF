
<div class="container">
    <div class="row">
        <h2>Alle Bewerber:innen</h2>
    </div>
    <div class="row">
       
          
        <!-- <p class="form-inline">
            <a href="index.php?r=applicant/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Erstellen</a>
        </p> -->

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Bewerbungsdatum</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="applicants">

            <?php

            require_once 'models/Applicant.php';

            // load and show all applicants from database
            $applicants = Applicant::getAll();
            
            foreach ($applicants as $a) {
                echo '<tr>';
                echo '<td>' . $a->getFirstName() . '</td>';
                echo '<td>' . $a->getLastName() . '</td>';
                echo '<td>' . $a->getApplicationDate() . '</td>';
                echo '<td>';
                echo '<a class="btn btn-info" href="index.php?r=applicant/view&id=' . $a->getId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-primary" href="index.php?r=applicant/update&id=' . $a->getId() . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="index.php?r=applicant/delete&id=' . $a->getId() . '"><span class="glyphicon glyphicon-remove"></span></a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>

            </tbody>
        </table>
    </div>
</div> <!-- /container -->
