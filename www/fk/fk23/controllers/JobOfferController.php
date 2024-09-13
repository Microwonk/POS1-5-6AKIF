<?php
session_start();
require_once('Controller.php');
require_once('models/Applicant.php');
require_once('models/JobOffer.php');
require_once('models/User.php');

class JobOfferController extends Controller
{
    /**
     * @param $route array, e.g. [joboffer, view]
     */
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if ($operation == 'index') {
            $this->actionIndex();
        } elseif ($operation == 'view') {
            $this->actionView($id);
        } elseif ($operation == 'create') {
            $this->actionCreate();
        } elseif ($operation == 'update') {
            $this->actionUpdate($id);
        } elseif ($operation == 'delete') {
            $this->actionDelete($id);
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

   

    public function actionIndex()
    {
        if (User::isLoggedIn()) {
            $model = JobOffer::getAll();
            $this->render('joboffer/index', $model);
        } else {
            $this->render('user/login');
        }
    }

    public function actionView($id)
    {
        $model = JobOffer::get($id);
        $this->render('joboffer/view', $model);
    }

    public function actionCreate()
    {
        $model = new JobOffer();

        if (!empty($_POST)) {
            $model->setTitle($this->getDataOrNull('title'));
            $model->setDescription($this->getDataOrNull('description'));
            $model->setRequirements($this->getDataOrNull('requirements'));
            $model->setSalary($this->getDataOrNull('salary'));
            $model->setLocation($this->getDataOrNull('location'));
            $model->setPostingDate($this->getDataOrNull('posting_date'));

            if ($model->save()) {
                $this->redirect('joboffer/index');
                return;
            }
        }

        $this->render('joboffer/create', $model);
    }

    public function actionUpdate($id)
    {
        $model = JobOffer::get($id);

        if (!empty($_POST)) {
            $model->setTitle($this->getDataOrNull('title'));
            $model->setDescription($this->getDataOrNull('description'));
            $model->setRequirements($this->getDataOrNull('requirements'));
            $model->setSalary($this->getDataOrNull('salary'));
            $model->setLocation($this->getDataOrNull('location'));
            $model->setPostingDate($this->getDataOrNull('posting_date'));

            if ($model->save()) {
                $this->redirect('joboffer/index');
                return;
            }
        }

        $this->render('joboffer/update', $model);
    }

    public function actionDelete($id)
    {
        if (!empty($_POST)) {
            if (JobOffer::delete($id)) {
                $this->redirect('joboffer/index');
            } else {
                // sql error
                $this->render('joboffer/delete', ['model' => JobOffer::get($id), 'error' => 'Error deleting Job Offer']);
            }
            return;
        }

        $this->render('joboffer/delete', JobOffer::get($id));
    }

}
