<h1 class="mt-3">Statistik</h1>

<!-- Search filters for each field -->
<div id="bmiRange" class="mt-5"></div>

<table class="table">
    <thead>
    <tr>
        <th>Datum</th>
        <th>Name</th>
        <th>BMI</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require_once("lib/db.func.inc.php");

    // delete
    if (isset($_POST['recordId'])) {
        $recordId = $_POST['recordId'];
        deleteRecord($recordId);
    }

    $data = getAll();
    foreach ($data as $d) {
        echo "<tr>";
        echo "<td>" . date("d.m.Y", strtotime($d['date'])) . "</td>";
        echo "<td>" . $d['name'] . "</td>";
        echo "<td>" . number_format($d['bmi'], 1) . "</td>";
        echo "<td><button class='btn btn-danger delete-btn' data-record-id='" . $d['id'] . "'>X</button></td>";
        echo "</tr>";
    }

    $bmis = array_map(function ($item) {
        return $item['bmi'];
    }, $data);

    $min = min($bmis);

    $max = max($bmis);
    
    ?>
    </tbody>
</table>

<script>

$(document).ready(function() {
   $(".delete-btn").click(function() {
       var recordId = $(this).data("record-id");
       var button = $(this); // Capture the button element
       
       if (confirm("Are you sure you want to delete this record?")) {
           $.ajax({
               type: "POST",
               url: "delete.php",
               data: { recordId: recordId },
               success: function(response) {
                   // Handle the response from the server
                   if (response === "success") {
                       // Use the captured button element to remove the row
                       button.closest('tr').remove();
                   }
               }
           });
       }
   });
});



$(function() {

    let minBMI = parseInt(<?= $min?>);
    let maxBMI = Math.ceil(<?= $max?>);

    $("#bmiRange").slider({
        range: true,
        min: minBMI,
        max: maxBMI,
        values: [minBMI, maxBMI],
        slide: function(event, ui) {
            $("#bmiRange .ui-slider-handle:eq(0)").html(ui.values[0]);
            $("#bmiRange .ui-slider-handle:eq(1)").html(ui.values[1]);
            filterTableByBMIRange(ui.values[0], ui.values[1]);
        }
    });
    // Display initial values on slider handles
    $("#bmiRange .ui-slider-handle:eq(0)").html($("#bmiRange").slider("values", 0));
    $("#bmiRange .ui-slider-handle:eq(1)").html($("#bmiRange").slider("values", 1));
});

// Function to filter the table based on BMI range
function filterTableByBMIRange(minValue, maxValue) {
    const tableRows = document.querySelectorAll("table tbody tr");
    tableRows.forEach((row) => {
        const bmi = parseFloat(row.querySelector("td:nth-child(3)").textContent);
        if (bmi >= minValue && bmi <= maxValue) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>