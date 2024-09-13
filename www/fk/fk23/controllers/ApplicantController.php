<?php
session_start();

require_once('Controller.php');
require_once('models/JobOffer.php');
require_once('models/Applicant.php');

class ApplicantController extends Controller
{
    /**
     * @param $route array, e.g. [applicant, view]
     */
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($operation == 'view') {
            $this->actionView($id);
        } elseif ($operation == 'update') {
            $this->actionUpdate($id);
        } elseif ($operation == 'delete') {
            $this->actionDelete($id);
        } elseif ($operation == 'filter') {
            $this->actionFilter($id);
        } elseif ($operation == 'create') {
            $this->actionCreate();
        } elseif ($operation == 'index') {
            $this->actionIndex();
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionIndex()
    {
        $model = Applicant::getAll();
        $this->render('applicant/index', $model);
    }


    public function actionCreate()
    {
       //TODO

       //$this->render('joboffer/create', $model);
    }


    public function actionFilter()
    {
        $model = JobOffer::getAll();
        $this->render('applicant/index_filter', $model);
    }


    public function actionView($id)
    {
        $model = Applicant::get($id);
        $this->render('applicant/view', $model);
    }

    public function actionUpdate($id)
    {
        $jobOffers = JobOffer::getAll();

        $model = Applicant::get($id);

        if (!empty($_POST)) {
            $model->setFirstName($this->getDataOrNull('first_name'));
            $model->setLastName($this->getDataOrNull('last_name'));
            $model->setEmail($this->getDataOrNull('email'));
            $model->setPhone($this->getDataOrNull('phone'));
            $model->setResume($this->getDataOrNull('resume'));
            $model->setApplicationDate($this->getDataOrNull('application_date'));
            $model->setJobOfferId($this->getDataOrNull('jobOffer_id'));

            if ($model->save()) {
                $this->redirect('applicant/view&id=' . $model->getId());
                return;
            }
        }

        $this->render('applicant/update', ['model' => $model, 'joboffers' => $jobOffers]);
    }

    public function actionDelete($id)
    {
        if (!empty($_POST)) {
            Applicant::delete($id);
            $this->redirect('home/index');
            return;
        }

        $this->render('applicant/delete', Applicant::get($id));
    }

}
