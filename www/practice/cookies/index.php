<?php

if (isset($_POST['title']) && isset($_POST['description'])) {
    require_once 'models/task.php';
    require_once 'models/tasklist.php';

    $task = new Task($_POST['title'], $_POST['description']);
    $taskList = TaskList::get();
    $taskList->addTask($task);
    $taskList->save();
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

        $taskList = TaskList::get();

        echo "<table class='table'>";
        echo "<tr><th>Title</th><th>Description</th><th>Completion</th><th>Complete</tj><th>Delete</tj></tr>";
        foreach($taskList->getTasks() as $task) {
            echo "<tr>";
            echo "<td>" . $task->getTitle() . "</td>";
            echo "<td>" . $task->getDescription() . "</td>";
            echo "<td>" . $task->getCompletion() . "</td>";
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