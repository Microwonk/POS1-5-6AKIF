<!-- Form-action bitte so belassen. -->
<div class="container vh-100">
    <div class="row">
    <?php

    //Teil A: Hier kommt Ihr PHP-Code...
    require_once("models/User.php");

    if (isset($_POST['login_submit'])) {
        $pw = $_POST['password'];
        $mail = $_POST['email'];
        $user = new User($mail, $pw);
        $user->login();
        if (count($user->getErrors()) != 0) {
            $message = "<div class='mt-2 alert alert-danger'><ul style='list-style:none'>";
            foreach($user->getErrors() as $k){
            $message .= "<li class='text-center'>" . $k . "</li>";
            }
            $message .= "</ul></div>";
            echo $message;
        } else {
            header("Location: ./index.php");
            exit(0);
        }
    }

    ?>
    </div>
    <div class="row p-5 mx-xxl-5">
        <div class="p-5 bg-light rounded">
            <h4 class="mb-4">Bitte anmelden</h4>
            <form action="index.php?r=home/index" method="POST" class="was-validated">
                <div class="my-3 form-floating">
                    <input type="email" class="form-control" required id="email" name="email" placeholder="E-Mail:">
                    <label for="email">E-Mail:</label>
                    <div class="invalid-feedback">keine Email!</div>
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" required minlength="2" class="form-control" id="pswd" name="password" placeholder="Passwort:">
                    <label for="pswd">Passwort:</label>
                    <div class="invalid-feedback">Passwort zu kurz!</div>
                </div>
                <button type="submit" name="login_submit" class="btn btn-primary btn-block">Anmelden</button>
            </form>
        </div>
    </div>
</div>




