<?php

namespace controllers;

use models\Measurement;

class MeasurementRESTController extends RESTController
{
    public function handleRequest(): void
    {
        switch ($this->method) {
            case 'GET':
                $this->handleGetRequest();
                break;
            case 'POST':
                $this->handleCreateRequest();
                break;
            case 'UPDATE':
                $this->handleUpdateRequest();
                break;
            case 'DELETE':
                $this->handleDeleteRequest();
                break;
            default:
                $this->response('method not allowed', 405);

        }
    }

    public function handleGetRequest(): void
    {
        $model = '';
        if ($this->verb == null && sizeof($this->args) == 0) {
            $model = Measurement::getAll();
        } else if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Measurement::get($this->args[0]);
        }
        $this->response($model);

    }

    public function handleCreateRequest(): void
    {
        $model = new Measurement();
        $model->setTime($this->getDataOrNull('time'));
        $model->setTemperature($this->getDataOrNull('temperature'));
        $model->setRain($this->getDataOrNull('rain'));
        $model->setStationId($this->getDataOrNull('station_id'));
        if ($model->save()) {
            $this->response("OK", 201);
        } else {
            $this->response($model->getErrors(), 400);
        }
    }

    public function handleUpdateRequest(): void
    {

        if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Measurement::get($this->args[0]);
            if ($model == null) {
                $this->response('ID: ' . $this->args[0] . ' not found', 404);
            } else {
                $model->setTime($this->getDataOrNull('time'));
                $model->setTemperature($this->getDataOrNull('temperature'));
                $model->setRain($this->getDataOrNull('rain'));
                $model->setStationId($this->getDataOrNull('station_id'));
                $model->setStation($this->getDataOrNull('station'));
                if ($model->save()) {
                    $this->response('OK', 201);
                } else {
                    $this->response($model->getErrors(), 400);
                }
            }

        } else {
            $this->response("Not Found", 404);
        }
    }

    public function handleDeleteRequest(): void
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Measurement::get($this->args[0]);
            if ($model != null && $model->delete($model->getId())) {
                $this->response('OK', 204);
            } else {
                $this->response($model->getErrors(), 400);
            }
        }
    }
}
