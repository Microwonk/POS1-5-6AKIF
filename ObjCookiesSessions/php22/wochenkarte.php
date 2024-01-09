<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wochenkarte</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <form action="logout.php" method="post">
      <input type="submit" name="logout" class="btn btn-link" value = "Logout">
   </form>

   <div class="container">
      <h1 class="mt-5 mb-3">Wochenkarte</h1>

      <div class="row">
         <?php
            require_once "images.php";         
            
            foreach($images as $i){
               echo "<div class='container-fluid border p-3 mb-4 d-flex flex-column align-items-center col-lg-4 justify-content-start text-center'>";
               echo "<h2 class=''>" . $i['tag'] . "</h2>";
               echo "<img class='img-fluid border m-2' src='$i[pfad]'>";
               echo "</div>";
            }
         ?>
      </div>
  </div>

</body>
</html>