<?php

// nur ein kleines Skript fuer das aufrufen der 
// completeTask methode der TaskList Klasse
require_once 'models/tasklist.php';
TaskList::get()->completeTask($_GET['id']);
header('Location: index.php');
