<?php

require_once 'models/tasklist.php';
TaskList::get()->completeTask($_GET['id']);
header('Location: index.php');
