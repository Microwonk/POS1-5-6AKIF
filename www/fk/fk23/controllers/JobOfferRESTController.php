<?php

require_once('RESTController.php');
require_once('models/JobOffer.php');
require_once('models/Applicant.php');

class JobOfferRESTController extends RESTController
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
     * get single/all job offers
     * single station: GET api.php?r=/joboffer/25 -> args[0] = 25
     * all stations: GET api.php?r=joboffer
     * all applicants of single job offer: GET api.php?r=/joboffer/2/applicant -> arg[0] = 2, args[1] = applicant
     */
    private function handleGETRequest()
    {
        if ($this->verb == null && sizeof($this->args) == 0) {
            $model = JobOffer::getAll();
            $this->response($model);
        } else if ($this->verb == null && sizeof($this->args) == 1) {
            $model = JobOffer::get($this->args[0]);
            $this->response($model);
        } else if ($this->verb == null && sizeof($this->args) == 2 && $this->args[1] == 'applicant') {
            //$model = Applicant::getAllByJobOffer($this->args[0]);
            $joboffer = JobOffer::get($this->args[0]);
            $model = $joboffer->getApplicants();
            $this->response($model);
        } else {
            $this->response("Bad request", 400);
        }
    }

    /**
     * create job offer: POST api.php?r=joboffer
     */
    private function handlePOSTRequest()
    {
        $model = new JobOffer();
        $model->setTitle($this->getDataOrNull('title'));
        $model->setLocation($this->getDataOrNull('location'));
        $model->setPostingDate($this->getDataOrNull('posting_date'));

        if ($model->save()) {
            $this->response("OK", 201);
        } else {
            $this->response($model->getErrors(), 400);
        }
    }

    /**
     * update job offer: PUT api.php?r=joboffer/25 -> args[0] = 25
     */
    private function handlePUTRequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {

            $model = JobOffer::get($this->args[0]);
            $model->setTitle($this->getDataOrNull('title'));
            $model->setLocation($this->getDataOrNull('location'));
            $model->setPostingDate($this->getDataOrNull('posting_date'));

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
     * delete job offer: DELETE api.php?r=joboffer/25 -> args[0] = 25
     */
    private function handleDELETERequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            if (JobOffer::delete($this->args[0])) {
                $this->response("OK");
            } else {
                $this->response("Error deleting Job Offer", 500);
            }
        } else {
            $this->response("Not Found", 404);
        }
    }
}
