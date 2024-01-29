<?php
// Start session
session_start();

// Static helper methods
require_once "models/helper.php";

// Load and parse data
$questions = parse_data(read_data());

// see if a user has voted durch eine session variable
$userHasVoted = isset($_SESSION['voted']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$userHasVoted) {
    // jede Frage durchgehen und schauen, ob eine Antwort ausgewählt wurde
    foreach ($questions as $question) {
        $questionId = $question->getId();
        if (isset($_POST["question{$questionId}"])) {
            // wird im pose gesetzt, kann man dann weiter verwenden.
            // ist out of scope fuer dieses simple beispiel.
            $selectedOptionId = $_POST["question{$questionId}"];
            // user hat abgestimmt
            $_SESSION['voted'] = true;
            $userHasVoted = true;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling</title>
</head>
<body>

<?php 
if (!$userHasVoted) {
    // formular anzeigen (simple)
    echo '<form action="index.php" method="post">';
    foreach ($questions as $q) {
        echo '<h3>' . $q->getQuestion() . '</h3>';
        $questionId = $q->getId();
        // fuer jede option ein input type radio
        foreach ($q->getOptions() as $option) {
            echo '<input type="radio" name="question' 
                . $questionId 
                . '" value="' 
                . $option['id'] 
                . '" id="question' 
                . $questionId 
                . $option['id'] 
                . '">';
            echo '<label for="question' 
                . $questionId 
                . $option['id'] 
                . '">' 
                . $option['text'] 
                . '</label><br>';
        }
    }
    echo '<hr><input type="submit" value="Submit"></form>';
} else {
    // man hat schon gevoted, e.g. session variable gesetzt
    echo '<p>You have already voted. Thank you!</p>';
}
?>

</body>
</html>