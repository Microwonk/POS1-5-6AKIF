<?php

require_once 'models/tasklist.php';
TaskList::get()->removeTask($_GET['id']);
header('Location: index.php');