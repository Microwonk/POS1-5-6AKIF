<?php
session_start();

require_once('Controller.php');
require_once('models/User.php');
require_once('models/JobOffer.php');

class HomeController extends Controller
{
    /**
     * @param $route array, e.g. [home, view]
     */
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';

        if ($operation == 'index') {
            $this->actionIndex();
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionIndex()
    {
        var_dump(User::isLoggedIn());
        if (User::isLoggedIn()) {
            $model = JobOffer::getAll();
            $this->render('joboffer/index', $model);
        } else {
            $this->render('user/login');
        }
    }
}
