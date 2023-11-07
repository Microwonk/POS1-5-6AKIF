<h1 class="mt-3">Statistik</h1>

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
</script>