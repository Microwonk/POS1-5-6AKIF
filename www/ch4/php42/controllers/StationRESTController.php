<?php

namespace controllers;

use models\Measurement;
use models\Station;

class StationRESTController extends RESTController
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
            case 'PUT':
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
        if ($this->verb == null && sizeof($this->args) == 0) {
            $model = Station::getAll();
        } else if ($this->verb == null && sizeof($this->args) == 2 && $this->args[1] == 'measurement') {
            $model = Measurement::getAllByStation($this->args[0]);
        } else if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Station::get($this->args[0]);
        } else {
            $model = Station::get($this->verb);
        }
        $this->response($model);

    }

    public function handleCreateRequest(): void
    {
        $model = new Station();
        $model->setName($this->getDataOrNull('name'));
        $model->setLocation($this->getDataOrNull('location'));
        $model->setAltitude($this->getDataOrNull('altitude'));

        if ($model->save()) {
            $this->response("OK", 201);
        } else {
            $this->response($model->getErrors(), 400);
        }
    }

    public function handleUpdateRequest(): void
    {
        if ($this->verb == null && sizeof($this->args) == 1) {

            $model = Station::get($this->args[0]);

            if ($model == null) {
                $this->response("Not found", 404);
            } else {
                $model->setName($this->getDataOrNull('name'));
                $model->setAltitude($this->getDataOrNull('altitude'));
                $model->setLocation($this->getDataOrNull('location'));

                if ($model->save()) {
                    $this->response("OK");
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

            Station::delete($this->args[0]);
            $this->response(204);

        } else {
            $this->response("Not Found", 404);
        }
    }
}