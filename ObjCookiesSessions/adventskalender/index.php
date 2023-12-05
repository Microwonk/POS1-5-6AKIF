<?php

    $offeneFenster = array();
    $versuchteFenster = array(); // werden nicht gespeichert, da sie nur eine Nachricht senden sollen
    if (isset($_COOKIE['fenster'])) {
        $offeneFenster = json_decode($_COOKIE['fenster'], false) ?: [];
    }

    //Falls auf ein Fenster geklickt wurde, setze das Cookie...
    if (isset($_GET['fenster'])) {
        $fensternr = filter_input(INPUT_GET, 'fenster', FILTER_VALIDATE_INT);

        if ($fensternr > 0 && $fensternr <= 24 && $fensternr <= date('d')) {
            $offeneFenster[] = $fensternr;
            $expireTimestamp = mktime(23, 59, 59, date("n"), 24, date("Y"));
            setcookie('fenster', json_encode($offeneFenster), $expireTimestamp, '/');
        } else {
            $versuchteFenster[] = $fensternr;
        }
    }
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Adventkalender</title>
</head>
<body>
    <header class="topheader">
        <h1>Adventkalender 2023</h1>
    </header>
    <main id="winter" class="fenstercontainer">

        <?php

            require_once('fenster.php');

            $html = '';
            $fensterTemplate = '
            <article class="fenster">
                <h2 class="fensterhead">NR</h2>
                <span class="fenstertext">BESCHREIBUNG</span>
                <a href="index.php?fenster=NR#NR">
                    <img id="NR" src="PFAD" alt="BESCHREIBUNG">
                </a>   
            </article>
            ';

            foreach (Fenster::get() as $key => $value) {
                $url = $value['pfad'];
                $beschriftung = $value['beschreibung'];
                $fensternr = $value['fensternr'];

                $fensterHTML = $fensterTemplate;

                if (in_array($fensternr, $offeneFenster))
                {
                    $fensterHTML = str_replace(
                        ['PFAD', 'NUMMER', 'NR', 'BESCHREIBUNG'],
                        [$url, $fensternr . '<br>' . $beschriftung, $fensternr, $beschriftung],
                        $fensterHTML
                    );
                } else {
                    $fensterHTML = str_replace(
                        ['PFAD', 'NUMMER', 'NR', 'BESCHREIBUNG'],
                        [
                            'bilder/fenster_default.jpg',
                            $fensternr,
                            $fensternr,
                            in_array($fensternr, $versuchteFenster) ? 'Du darfst das Fenster nicht öffnen!' : '',
                        ],
                        $fensterHTML
                    );
                }
                $html .= $fensterHTML;
            }
            echo $html;
        ?>

    </main>
    <footer>&copy;  Nicolas Frey</footer>
    <script src="js/schnee.js"></script>
</body>
</html>