<?php

require_once('RESTController.php');
require_once('models/Applicant.php');

class ApplicantRESTController extends RESTController
{
    public function handleRequest()
    {
        switch ($this->method) {
            case 'GET':
                $this->handleGETRequest();
                break;
            case 'POST':
                $this->handlePOSTRequest();
                break;
            case 'PUT':
                $this->handlePUTRequest();
                break;
            case 'DELETE':
                $this->handleDELETERequest();
                break;
            default:
                $this->response('Method Not Allowed', 405);
                break;
        }
    }

    /**
     * get single/all applicants
     * single measurements: GET api.php?r=applicant/25 -> args[0] = 25 (applicant_id)
     * all measurements: GET api.php?r=applicant
     */
    private function handleGETRequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Applicant::get($this->args[0]);  // single applicant
            $this->response($model);
        } else if ($this->verb == null && empty($this->args)) {
            $model = Applicant::getAll();             // all applicants
            $this->response($model);
        } else {
            $this->response("Bad request", 400);
        }
    }

    /**
     * create measurement: POST api.php?r=measurement
     */
    private function handlePOSTRequest()
    {
        $model = new Applicant();
        $model->setFirstName($this->getDataOrNull('first_name'));
        $model->setLastName($this->getDataOrNull('last_name'));
        $model->setApplicationDate($this->getDataOrNull('application_date'));
        $model->setJobOfferId($this->getDataOrNull('jobOffer_id'));

        if ($model->save()) {
            $this->response("OK", 201);
        } else {
            $this->response($model->getErrors(), 400);
        }
    }

    /**
     * update applicant: PUT api.php?r=applicant/25 -> args[0] = 25
     */
    private function handlePUTRequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {

            $model = Applicant::get($this->args[0]);
            $model->setFirstName($this->getDataOrNull('first_name'));
            $model->setLastName($this->getDataOrNull('last_name'));
            $model->setApplicationDate($this->getDataOrNull('application_date'));
            $model->setJobOfferId($this->getDataOrNull('jobOffer_id'));

            if ($model->save()) {
                $this->response("OK");
            } else {
                $this->response($model->getErrors(), 400);
            }
        } else {
            $this->response("Not Found", 404);
        }
    }

    /**
     * delete applicant: DELETE api.php?r=applicant/25 -> args[0] = 25
     */
    private function handleDELETERequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            Applicant::delete($this->args[0]);
            $this->response("OK", 200);
        } else {
            $this->response("Not Found", 404);
        }
    }
}
