<!DOCTYPE html>
<html>
<head>
    <title>Benutzer Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <h1 class="mt-5 mb-3">Benutzerdetails</h1>

    <div class="row">
        <a href="index.php?search=<?=$_GET['search'] ??= ''?>" class="text-decoration-none mb-3">zurück</a>
    </div>

    <div>
        <?php

        require_once('lib/db.data.php');

        const db_names_to_view_names = [
            'firstname' => 'Vorname',
            'lastname' => 'Nachname',
            'birthdate' => 'Geburtstag',
            'email' => 'E-Mail',
            'phone' => 'Telefon',
            'street' => 'Straße',
        ];

        if (isset($_GET['id']) || isset($_GET['search'])) {

            if (!isset($_GET['id'])) {
                $user = getFilteredData($_GET['search']);
                if (count($user) != 1) {
                    header('Location: index.php?search=' . urlencode($_GET['search']));
                    exit;
                }
                $user_id = $user ? $user[0]['id'] : null;
            } else {
                $user_id = intval($_GET['id']);
            }

            $user = getDataPerId($user_id);

            if ($user) {
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                foreach ($user as $key => $value) {
                    if ($key == 'id') continue;
                    echo '<tr>';
                    echo '<td>' . db_names_to_view_names[$key] . '</td>';
                    echo '<td>';

                    if ($key == 'email' || $key == 'phone') echo '<a href="' . ($key == 'email' ? 'mailto:' : 'tel:') . $value . '">';

                    echo $value;

                    if ($key == 'email' || $key == 'phone') echo '</a>';

                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p class="alert alert-danger">User konnte nicht gefunden werden.</p>';
            }
        } else {
            echo '<p class="alert alert-danger">Keine Parameter wurden angegeben.</p>';
        }
        ?>

    </div>
</div>

</body>
</html>
