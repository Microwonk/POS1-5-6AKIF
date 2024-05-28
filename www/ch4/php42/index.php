<?php

require_once 'bootstrap.php';

use controllers\Controller;
use controllers\HomeController;
use controllers\MeasurementController;
use controllers\StationController;

// entry point for the application
// e.g. http://localhost/php42/index.php?r=station/view&id=25
// select route: station/view&id=25 -> controller=station, action=view, id=25
$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['home'];
$controller = sizeof($route) > 0 ? $route[0] : 'home';

if ($controller == 'home') {
    (new HomeController())->handleRequest($route);
} else if ($controller == 'station') {
    (new StationController())->handleRequest($route);
} else if ($controller == 'measurement') {
    (new MeasurementController())->handleRequest($route);
} else {
    Controller::showError("Page not found", "Page for operation " . $controller . " was not found!");
}


