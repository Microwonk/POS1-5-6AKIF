<?php
require_once "bootstrap.php";

use controller\CustomersRESTController;
use controller\OrdersRESTController;
use controller\RESTController;

$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['orders'];
$controller = sizeof($route) > 0 ? $route[0] : 'orders';

if ($controller == 'customers') {
    try {
        (new CustomersRESTController())->handleRequest();
    } catch (Exception $e) {
        RESTController::responseHelper($e->getMessage(), $e->getCode());
    }

} else if ($controller == 'orders') {
    try {
        (new OrdersRESTController())->handleRequest();
    } catch (Exception $e) {
        RESTController::responseHelper($e->getMessage(), $e->getCode());
    }

}