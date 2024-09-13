<div class="container">
    <div class="row">
        <h2>Bewerberübersicht</h2>
       
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="btn btn-light dropdown-toggle" name="jobOffer_id" style="width: 200px">
                <?php
                foreach($model as $jobOffer):
                    echo '<option value="' . $jobOffer->getId() . '">' . $jobOffer->getTitle() . '</option>';
                endforeach;
                ?>
            </select>
            <button id="btnSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Bewerber anzeigen</button>
            <!-- <a class="btn btn-secondary" href="index.php?r=joboffer/index"><span class="glyphicon glyphicon-pencil"></span> Stellenausschreibungen bearbeiten</a> -->
        <br/>


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
                <tr>
                    <td>Dummy</td>
                    <td>Dum Dum</td>
                    <td>2023-09-01</td>
                    <td>
                        <a class="btn btn-info" href="index.php?r=applicant/view&id=2"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a class="btn btn-primary" href="index.php?r=applicant/update&id=2"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="btn btn-danger" href="index.php?r=applicant/delete&id=2"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div> <!-- /container -->
