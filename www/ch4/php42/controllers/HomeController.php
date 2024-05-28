<?php

namespace controllers;

use models\Station;

class HomeController extends Controller
{
    /**
     * @param $route array, e.g. [home, view]
     */
    public function handleRequest(array $route): void
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = $_GET['id'] ?? 0;

        if ($operation == 'index') {
            $this->actionIndex();
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionIndex(): void
    {
        $model = Station::getAll();
        $this->render('home/index', $model);
    }

}
