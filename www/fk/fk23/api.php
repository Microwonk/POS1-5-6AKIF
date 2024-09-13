<?php

require_once('controllers/RESTController.php');

// entry point for the rest api
// e.g. GET http://localhost/bewerbungsportal/api.php?r=applicant/25
// or with url_rewrite GET http://localhost/bewerbungsportal/api/applicant/25
// select route: applicant/25 -> controller=applicant, action=GET, id=25
$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['applicant'];
$controller = sizeof($route) > 0 ? $route[0] : 'applicant';

if ($controller == 'joboffer') {
    require_once('controllers/JobOfferRESTController.php');

    try {
        (new JobOfferRESTController())->handleRequest();
    } catch (Exception $e) {
        RESTController::responseHelper($e->getMessage(), $e->getCode());
    }
} else if ($controller == 'applicant') {
    require_once('controllers/ApplicantRESTController.php');

    try {
        (new ApplicantRESTController())->handleRequest();
    } catch (Exception $e) {
        RESTController::responseHelper($e->getMessage(), $e->getCode());
    }
} else {
    RESTController::responseHelper('REST-Controller "' . $controller . '" not found', '404');
}
