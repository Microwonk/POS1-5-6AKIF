<?php

namespace controllers;

use controllers\Controller;
use models\Measurement;
use models\Station;

class MeasurementController extends Controller
{
    /**
     * @param $route array, e.g. [measurement, view]
     */
    public function handleRequest(array $route): void
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = $_GET['id'] ?? 0;
        if ($operation == 'view') {
            $this->actionView($id);
        } elseif ($operation == 'update') {
            $this->actionUpdate($id);
        } elseif ($operation == 'delete') {
            $this->actionDelete($id);
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionView(int $id): void
    {
        $model = Measurement::get($id);
        $this->render('measurement/view', $model);
    }

    public function actionUpdate(int $id): void
    {
        $stations = Station::getAll();

        $model = Measurement::get($id);

        if (!empty($_POST)) {
            $model->setTime($this->getDataOrNull('time'));
            $model->setTemperature($this->getDataOrNull('temperature'));
            $model->setRain($this->getDataOrNull('rain'));
            $model->setStationId($this->getDataOrNull('station_id'));

            if ($model->save()) {
                $this->redirect('measurement/view&id=' . $model->getId());
                return;
            }
        }

        $this->render('measurement/update', ['model' => $model, 'stations' => $stations]);
    }

    public function actionDelete(int $id): void
    {
        if (!empty($_POST)) {
            Measurement::delete($id);
            $this->redirect('home/index');
            return;
        }

        $this->render('measurement/delete', Measurement::get($id));
    }

}
