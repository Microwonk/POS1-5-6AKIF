$(document).ready(function () {

    // filtern der Messwerte im Frontend mittels JQuery.
    $("#filterMesswerte").on("keyup", function () {
        const value = $(this).val();
        console.debug(value);
        $("#measurements tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    const station = $('#station_id');

    $('#btnMesswerteClear').click(function () {
        $('#filter').val('');
        getAllMeasurements(station.val());
    });

    station.change(function () {
        let selectedStationId = this.value;
        getAllMeasurements(selectedStationId);
    });
    let defaultStationId = station.val();
    getAllMeasurements(defaultStationId);
});

let chart;
//Das sind nur default Werte diese werden mit der updateChart() Methode überschrieben.
$(document).ready(function () {
    const ctx = document.getElementById('chart').getContext('2d');
    chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
            datasets: [
                {
                    label: "Temperatur [°C]",
                    data: [14, 17, 17, 18, 16, 13, 14],
                    borderColor: 'rgb(255, 192, 192)',
                    backgroundColor: 'rgb(255, 192, 192, 0.2)',
                    borderWidth: 1,
                    pointRadius: 0,
                    fill: false,
                    tension: 0
                },
                {
                    label: "Regen [mm]",
                    data: [1, 2, 1, 0, 3, 1, 2], // Beispielwerte, diese werden durch die tatsächlichen Werte ersetzt
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgb(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    pointRadius: 0,
                    fill: false,
                    tension: 0
                }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        beginAtZero: true,
                        max: 25
                    }
                }]
            }
        }
    });
})

const updateChart = (measurements) => {
    // Daten lesen und in die variablen speichern
    const labels = measurements.map(measurement => measurement.time);
    const data = measurements.map(measurement => measurement.temperature);
    const data2 = measurements.map(measurement => measurement.rain);

    // Update Chart Data
    chart.data.labels = labels;
    chart.data.datasets[0].data = data;
    chart.data.datasets[1].data = data2;

    // Update chart
    chart.update();
}

const getAllMeasurements = async (station_id = 1) => {
    try {
        const response = await fetch("api/station/" + station_id + "/" + "measurement");
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const measurements = await response.json();
        $('#measurements').html(parseMeasurementsTable(measurements));
        updateChart(measurements);
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

const parseMeasurementsTable = (data) => {
    let ret = "";
    $.each(data, function (index, measurement) {
        ret += "<tr>";
        ret += "<td>" + measurement.time + "</td>";
        ret += "<td>" + measurement.temperature + "</td>";
        ret += "<td>" + measurement.rain + "</td>";
        ret += "<td>";
        ret += '<a class="btn btn-info" href="index.php?r=measurement/view&id=' + measurement.id + '"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;'
        ret += '<a class="btn btn-primary" href="index.php?r=measurement/update&id=' + measurement.id + '"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;'
        ret += '<a class="btn btn-danger" href="index.php?r=measurement/delete&id=' + measurement.id + '"><span class="glyphicon glyphicon-remove"></span></a>';
        ret += "</td>";
        ret += "</tr>";
    });

    return ret;
}


