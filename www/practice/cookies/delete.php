<?php

// nur ein kleines Skript fuer das aufrufen der 
// removeTask methode der TaskList Klasse
require_once 'models/tasklist.php';
TaskList::get()->removeTask($_GET['id']);
header('Location: index.php');