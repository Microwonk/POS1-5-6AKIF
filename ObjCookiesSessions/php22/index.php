<?php

require_once "models/cookie_helper.php";

$user;

if (CookieHelper::checkCookiesAllowed()) {
   session_start();
}


if (isset($_POST["cookie_submit"])) {
   CookieHelper::allowCookies();
   header("refresh:0");
   exit();
}

if (isset($_POST['login_submit'])) {
   require_once "models/user.php";

   $mail = $_POST['mail'];
   $pw = $_POST['password'];

   $user = new User($mail, $pw);

   if($user->validate()){
      $user->login();
      if(count($user->getErrors()) == 0) {
         header("Location: wochenkarte.php");
         exit(); 
      } else {
         $message = "<div class='container alert alert-danger'><ul style='list-style:none'>";
         foreach($user->getErrors() as $k){
            $message .= "<li>" . $k . "</li>";
         }
         $message .= "</ul></div>";
      }
   }
   else{
      $message = "<div class='container alert alert-danger'><ul style='list-style:none'>";
      $message .= "<li> Die eingegebenen Daten sind ungültig </li>";
      foreach($user->getErrors() as $k => $v){
         $message .= "<li>" . $v . "</li>";
      }
      $message .= "</ul></div>";
   }  
   echo $message;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <title>Wochen-Karte Anmeldung</title>
</head>
<body>

   <?php
   if (CookieHelper::checkCookiesAllowed()) {
   ?>

   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="col-md-6">
               <div class="card">
                  <div class="card-header">Wochenkarte-Login</div>
                  <div class="card-body">
                     <form method="post" action="index.php">
                           <div class="form-group">
                              <label for="mail">Email:</label>
                              <input type="email" class="form-control" id="mail" name="mail" required>
                           </div>
                           <div class="form-group">
                              <label for="password">Passwort:</label>
                              <input type="password" class="form-control" id="password" name="password" required>
                           </div>
                           <button type="submit" name="login_submit" class="btn btn-primary">Anmelden</button>
                     </form>
                  </div>
               </div>
         </div>
      </div>
   </div>
   <?php
   }
   else {
   ?>
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="col-md-6">
               <div class="card">
                  <div class="card-header">Cookie-Erlaubnis</div>
                  <div class="card-body">
                     <form method="post" action="index.php">
                           <p>
                              Diese Website verwendet Cookies, um die Benutzererfahrung zu verbessern.
                              Durch die Nutzung unserer Website stimmen Sie unserer Cookie-Richtlinie zu.
                           </p>
                           <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="cookieCheckbox" name="cookie_submit" required>
                              <label class="form-check-label" for="cookieCheckbox">Ich stimme der Verwendung von Cookies zu.</label>
                           </div>
                           <button type="submit" class="btn btn-primary mt-3">Zustimmen</button>
                     </form>
                  </div>
               </div>
         </div>
      </div>
   </div>
   <?php
   }
   ?>
</body>
</html>