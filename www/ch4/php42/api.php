<?php

require_once 'bootstrap.php';

// entry point for the application
// e.g. http://localhost/php42/index.php?r=station/view&id=25
// select route: station/view&id=25 -> controller=station, action=view, id=25
use controllers\Controller;
use controllers\MeasurementRESTController;
use controllers\RESTController;
use controllers\StationRESTController;

$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['home'];
$controller = sizeof($route) > 0 ? $route[0] : 'home';

if ($controller == 'station') {
    try {
        (new StationRESTController())->handleRequest();
    } catch (Exception $e) {
        RESTController::responseHelper($e->getMessage(), $e->getCode());
    }

} else if ($controller == 'measurement') {
    try {
        (new MeasurementRESTController())->handleRequest();
    } catch (Exception $e) {
        RESTController::responseHelper($e->getMessage(), $e->getCode());
    }

} else {
    Controller::showError("Page not found", "Page for operation " . $controller . " was not found!");
}
