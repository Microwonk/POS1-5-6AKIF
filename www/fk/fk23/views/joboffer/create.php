<div class="container">
    <div class="row">
        <h2>Stellenausschreibung erstellen</h2>
    </div>

    <form class="form-horizontal" action="index.php?r=joboffer/create" method="post">

        <?php
        include "_form.php";
        ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Erstellen</button>
            <a class="btn btn-default" href="index.php?r=joboffer/index">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
