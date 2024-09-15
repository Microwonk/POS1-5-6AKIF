<div class="container">

<div class="row">
<?php
    session_start();

    const EMAIL = 'admin@europaparlament.gov';
    const PASSWD = 'testitest';

    $mail = '';
    $passwd = '';

    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mail = $_POST['email'] ?? '';
        $passwd = $_POST['password'] ?? '';
        if ($mail === EMAIL) {
            if ($passwd === PASSWD) {
                $_SESSION['mail'] = $mail;
                header('Location: b_formular.php');
                exit(0);
            } else {
                $errors[] = "falsches Passwort!";
            }
        } else {
            if ($passwd !== PASSWD) {
                $errors[] = "falsches Passwort!";
            }
            $errors[] = "falsche Email!";
        }
    }
    foreach ($errors as $e) {
        echo '<div class=" m-3 alert alert-danger">' . $e . '</div>';
    }
?>
</div>
<head>
    <link rel="stylesheet" href="bootstrap.min.css"/>
</head>

    <div class="row text-center p-5">
        <h1>Anmelden</h1>
    </div>
    <div class="row">
        <div class="form-group">
            <form method="POST" action="b_anmeldung.php">
                <div class="form-floating my-3">
                    <input class="form-control" type="email" required name="email" id="email" placeholder="Email:" value="<?= $mail ?>">
                    <label for="email">Email:</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="password" required minlength="3" name="password" id="password" placeholder="Passwort:" value="<?= $passwd ?>">
                    <label for="password">Passwort:</label>
                </div>
                <button type="submit" class="btn btn-danger btn-block">Anmelden</button>
            </form>
        </div>
    </div>
</div>
