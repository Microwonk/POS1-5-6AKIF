<?php
require_once "bootstrap.php";

$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['home'];
$controller = sizeof($route) > 0 ? $route[0] : 'home';