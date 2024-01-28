<?php
// Start session
session_start();

// Static helper methods
require_once "models/helper.php";
// Load and parse data
$questions = parse_data(read_data());

$userHasVoted = isset($_SESSION['voted']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$userHasVoted) {
    foreach ($questions as $question) {
        $questionId = $question->getId();
        if (isset($_POST["question{$questionId}"])) {
            $selectedOptionId = $_POST["question{$questionId}"];
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

<?php if (!$userHasVoted) : ?>
<form action="index.php" method="post">
    <?php foreach ($questions as $q) : ?>
        <h3><?php echo $q->getQuestion(); ?></h3>
        <?php $questionId = $q->getId(); ?>
        <?php foreach ($q->getOptions() as $option) : ?>
            <input 
                type="radio" 
                name="question<?php echo $questionId; ?>" 
                value="<?php echo $option['id']; ?>" 
                id="question<?php echo $questionId . $option['id']; ?>">
            <label 
                for="question<?php echo $questionId . $option['id']; ?>"><?php echo $option['text']; ?>
            </label>
            <br>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <hr>
    <input type="submit" value="Submit">
</form>
<?php else : ?>
<p>You have already voted. Thank you!</p>
<?php endif; ?>

</body>
</html>