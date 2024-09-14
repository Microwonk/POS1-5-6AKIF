<!-- Form-action bitte so belassen. -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <?php

    //Teil A: Hier kommt Ihr PHP-Code...
    require_once("models/User.php");

    if (isset($_POST['login_submit'])) {
        $pw = $_POST['password'];
        $mail = $_POST['email'];
        $user = new User($mail, $pw);
        $user->login();
        if (count($user->getErrors()) != 0) {
            $message = "<div class='mt-2 container alert alert-danger'><ul style='list-style:none'>";
            foreach($user->getErrors() as $k){
            $message .= "<li>" . $k . "</li>";
            }
            $message .= "</ul></div>";
            echo $message;
        } else {
            header("Location: ./index.php");
            exit(0);
        }
    }

    ?>
    <div class="p-4 bg-light" style="width: 300px;">
        <h4 class="mb-4">Bitte anmelden</h4>
        <form action="index.php?r=home/index" method="POST">
            <input type="email" class="form-control my-3" name="email" placeholder="E-Mail">
            <input type="password" class="form-control my-3" name="password" placeholder="Passwort">
            <button type="submit" name="login_submit" class="btn btn-primary form-control">Anmelden</button>
        </form>
    </div>
</div>




