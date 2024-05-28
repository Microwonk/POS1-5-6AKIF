<div class="container">
    <div class="row">
        <h2>Awesome Wetterstation</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="form-control" id='station_id' name="station_id" style="width: 200px">
                <?php
                foreach($model as $station):
                    echo '<option value="' . $station->getId() . '">' . $station->getName() . '</option>';
                endforeach;
                ?>
            </select>
            <a class="btn btn-default" href="index.php?r=station/index"><span class="glyphicon glyphicon-pencil"></span> Messstationen bearbeiten</a>

            <canvas id="chart" width="auto" height="auto"></canvas>

        <br/>
        <input id="filterMesswerte" type="text" class="form-control" name="name" maxlength="32" placeholder="Suche">
        <button id="btnMesswerteClear" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span>Filter löschen</button>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zeitpunkt</th>
                <th>Temperatur [C°]</th>
                <th>Regenmenge [mm]</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="measurements"></tbody>
        </table>
    </div>
</div> <!-- /container -->
