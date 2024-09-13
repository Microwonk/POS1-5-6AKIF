<?php

require_once('controllers/Controller.php');

// entry point for the application
$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['home'];
$controller = sizeof($route) > 0 ? $route[0] : 'home';

if ($controller == 'home') {
    require_once('controllers/HomeController.php');
    (new HomeController())->handleRequest($route);
} else if ($controller == 'joboffer') {
    require_once('controllers/JobOfferController.php');
    (new JobOfferController())->handleRequest($route);
} else if ($controller == 'applicant') {
    require_once('controllers/ApplicantController.php');
    (new ApplicantController())->handleRequest($route);
} else {
    Controller::showError("Page not found", "Page for operation " . $controller . " was not found!");
}

?>
