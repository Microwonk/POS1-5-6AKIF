<?php

if (isset($_POST['title']) && isset($_POST['description'])) {
    require_once 'models/task.php';
    require_once 'models/tasklist.php';

    $task = new Task($_POST['title'], $_POST['description']);
    // holen der TaskList mittels singleton pattern
    // wird dann direkt ein neuer Task geaddet
    TaskList::get()->addTask($task);
    // hier muss die taskliste nicht gespeichert werden, da sie
    // in der methode selbst schon gespeichert wird
    /* $taskList->save(); */
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Tasks</title>
</head>
<body>

<div class="container">
    <div class="row">
        <form action="index.php" method="post">
            <input type="text" name="title" placeholder="Title">
            <input type="text" name="description" placeholder="Description">
            <input class="btn btn-primary" type="submit" value="Add">
        </form>
    </div>
    <div class="row">
        <?php
        
        require_once 'models/task.php';
        require_once 'models/tasklist.php';

        // wieder mittels singleton pattern geholt
        $taskList = TaskList::get();

        echo "<table class='table'>";
        // table header
        echo "<tr><th>Title</th><th>Description</th><th>Completion</th><th>Complete</tj><th>Delete</tj></tr>";
        foreach($taskList->getTasks() as $task) {
            echo "<tr>";
            // ersten 3 spalten werden ausgegeben
            echo "<td>" . $task->getTitle() . "</td>";
            echo "<td>" . $task->getDescription() . "</td>";
            echo "<td>" . $task->getCompletion() . "</td>";
            // die Actions kann man genau so gut mit post variablen machen,
            // so ist es aber ein wenig simpler. (mit hrefs)
            echo "<td><a class='btn btn-primary' href='complete.php?id=" . $task->getId() . "'>Complete</a></td>";
            echo "<td><a class='btn btn-danger' href='delete.php?id=" . $task->getId() . "'>Delete</a></td>";

            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</div>


</body>
</html>