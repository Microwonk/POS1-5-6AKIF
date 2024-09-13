<?php

require_once("DatabaseObject.php");
require_once("Applicant.php");

class JobOffer implements DatabaseObject, JsonSerializable
{
    private $id;
    private $title;
    private $description;
    private $requirements;
    private $salary;
    private $location;
    private $posting_date;

    private $errors = [];

    public function validate()
    {
        return $this->validateTitle() &
            $this->validateDescription() &
            $this->validateRequirements() &
            $this->validateSalary() &
            $this->validateLocation() &
            $this->validatePostingDate();
    }

    public function validateTitle()
    {
        if (!is_string($this->title) || empty($this->title)) {
            $errors['title'] = "Titel muss eine nicht-leere Zeichenkette sein.";
            return false;
        } else {
            unset($this->errors['title']);
            return true;
        }
    }

    public function validateDescription()
    {
        if (!is_string($this->description) || empty($this->description)) {
            $errors['description'] = "Die Beschreibung muss eine nicht-leere Zeichenfolge sein.";
            return false;
        } else {
            unset($this->errors['description']);
            return true;
        }
    }

    public function validateRequirements()
    {
        if (!is_string($this->requirements) || empty($this->requirements)) {
            $errors['requirements'] = "Die Anforderungen müssen eine nicht-leere Zeichenkette sein.";
            return false;
        } else {
            unset($this->errors['requirements']);
            return true;
        }
    }

    public function validateSalary()
    {
        if (!is_numeric($this->salary) || $this->salary < 0) {
            $errors['salary'] = "Der Gehalt muss ein nicht-negativer numerischer Wert sein.";
            return false;
        } else {
            unset($this->errors['salary']);
            return true;
        }
    }

    public function validateLocation()
    {
        if (!is_string($this->location) || empty($this->location)) {
            $errors['location'] = "Der Ort muss eine nicht-leere Zeichenkette sein.";
            return false;
        } else {
            unset($this->errors['location']);
            return true;
        }
    }

    public function validatePostingDate()
    {
        // Validate the date format (YYYY-MM-DD)
        $date = DateTime::createFromFormat('Y-m-d', $this->posting_date);
        $errors = DateTime::getLastErrors();
        if (!$date || $errors['warning_count'] || $errors['error_count']) {
            $errors['posting_date'] = "Ungültiges Datumsformat. Bitte verwenden Sie JJJJ-MM-TT.";
            return false;
        } else {
            unset($this->errors['posting_date']);
            return true;
        }
    }

    /**
     * create or update an object
     * @return boolean true on success
     */
    public function save()
    {
        if ($this->title != null && $this->description != null && $this->requirements != null && $this->salary != null && $this->location != null && $this->posting_date != null) {
            if ($this->id != null) {
                $this->update();
            } else {
                $this->id = $this->create();
            }
            return true;
        }

        return false;
    }

    /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create()
    {
        $jobOffers = JobOffer::getAll();
        $lastId = 0;

        // Iterate over all job offers to find last id
        foreach ($jobOffers as $j) {
            if ($j->getId() > $lastId) {
                $lastId = $j->getId();
            }
        }

        // new job offer object
        $jobOffer = new JobOffer();
        $jobOffer->setId($lastId + 1);
        $jobOffer->setTitle($this->getTitle());
        $jobOffer->setDescription($this->getDescription());
        $jobOffer->setRequirements($this->getRequirements());
        $jobOffer->setSalary($this->getSalary());
        $jobOffer->setLocation($this->getLocation());
        $jobOffer->setPostingDate($this->getPostingDate());

        // all job offer objects
        array_push($jobOffers, $jobOffer);

        // Convert job offers data to JSON format
        $jsonData = json_encode($jobOffers, JSON_PRETTY_PRINT);

        // Check if JSON encoding was successful
        if ($jsonData === false) {
            echo 'Error encoding JSON.';
            exit;
        }

        // Write JSON data to a file
        $filename = 'models/joboffers.json';
        if (file_put_contents($filename, $jsonData) === false) {
            echo 'Error writing to JSON file.';
        } else {
            echo 'Job offers data written to JSON file successfully.';
        }

        return $lastId;
    }

    /**
     * Saves the object to the database
     */
    public function update()
    {
        $jobOffers = JobOffer::getAll();

        // Iterate over all job offers to find the job offer to update
        foreach ($jobOffers as $jobOffer) {
            if ($jobOffer->getId() == $this->id) {
                $jobOffer->setTitle($this->getTitle());
                $jobOffer->setDescription($this->getDescription());
                $jobOffer->setRequirements($this->getRequirements());
                $jobOffer->setSalary($this->getSalary());
                $jobOffer->setLocation($this->getLocation());
                $jobOffer->setPostingDate($this->getPostingDate());
            }
        }

        // Convert job offers data to JSON format
        $jsonData = json_encode($jobOffers, JSON_PRETTY_PRINT);

        // Check if JSON encoding was successful
        if ($jsonData === false) {
            echo 'Error encoding JSON.';
            exit;
        }

        // Write JSON data to a file
        $filename = 'models/joboffers.json';
        if (file_put_contents($filename, $jsonData) === false) {
            echo 'Error writing to JSON file.';
        } else {
            echo 'Job offers data written to JSON file successfully.';
        }
    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id)
    {
        $jobOffer = null;

        // Read job offers data from JSON file
        $jsonData = file_get_contents('models/joboffers.json');
        $jobOffersData = json_decode($jsonData, true);

        // Check if data is successfully loaded
        if ($jobOffersData === null) {
            echo 'Error parsing JSON file.';
            exit;
        }

        // Iterate over each job offer
        foreach ($jobOffersData as $d) {

            if ($d['id'] == $id) {
                $jobOffer = new JobOffer();
                $jobOffer->setId($d['id']);
                $jobOffer->setTitle($d['title']);
                $jobOffer->setDescription($d['description']);
                $jobOffer->setRequirements($d['requirements']);
                $jobOffer->setSalary($d['salary']);
                $jobOffer->setLocation($d['location']);
                $jobOffer->setPostingDate($d['posting_date']);
                break;
            }
        }

        return $jobOffer;
    }

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll()
    {
        $jobOffers = [];

        // Read job offers data from JSON file
        $jsonData = file_get_contents('models/joboffers.json');
        $jobOffersData = json_decode($jsonData, true);

        // Check if data is successfully loaded
        if ($jobOffersData === null) {
            echo 'Error parsing JSON file.';
            exit;
        }

        // Iterate over each job offer
        foreach ($jobOffersData as $d) {
            $jobOffer = new JobOffer();
            $jobOffer->setId($d['id']);
            $jobOffer->setTitle($d['title']);
            $jobOffer->setDescription($d['description']);
            $jobOffer->setRequirements($d['requirements']);
            $jobOffer->setSalary($d['salary']);
            $jobOffer->setLocation($d['location']);
            $jobOffer->setPostingDate($d['posting_date']);

            array_push($jobOffers, $jobOffer);
        }

        return $jobOffers;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     * @return bool true on success
     */
    public static function delete($id)
    {
        $jobOffers = JobOffer::getAll();
        $index = 0;

        // Iterate over all job offers to find the job offer to delete
        foreach ($jobOffers as $jobOffer) {
            if ($jobOffer->getId() == $id) {
                // remove item at $index
                unset($jobOffers[$index]);
            }
            $index++;
        }
        // Re-index the array elements
        $jobOffers = array_values($jobOffers);

        // Convert job offers data to JSON format
        $jsonData = json_encode($jobOffers, JSON_PRETTY_PRINT);

        // Check if JSON encoding was successful
        if ($jsonData === false) {
            echo 'Error encoding JSON.';
            exit;
        }

        // Write JSON data to a file
        $filename = 'models/joboffers.json';
        if (file_put_contents($filename, $jsonData) === false) {
            echo 'Error writing to JSON file.';
        } else {
            echo 'Job offers data written to JSON file successfully.';
        }

        return true;    // success
    }

    public function getApplicants()
    {
        $applicants = [];

        // Read job offers data from JSON file
        $jsonData = file_get_contents('models/applicants.json');
        $applicantsData = json_decode($jsonData, true);

        // Check if data is successfully loaded
        if ($applicantsData === null) {
            echo 'Error parsing JSON file.';
            exit;
        }

        // Iterate over each job offer
        foreach ($applicantsData as $d) {
            if ($d['joboffer_id'] == $this->id) {
                $applicant = new Applicant();
                $applicant->setId($d['id']);
                $applicant->setFirstName($d['first_name']);
                $applicant->setLastName($d['last_name']);
                $applicant->setEmail($d['email']);
                $applicant->setPhone($d['phone']);
                $applicant->setResume($d['resume']);
                $applicant->setApplicationDate($d['application_date']);
                $applicant->setJobOfferId($d['joboffer_id']);

                array_push($applicants, $applicant);
            }
        }

        return $applicants;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => intval($this->id),
            "title" => $this->title,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'salary' => $this->salary,
            "location" => $this->location,
            "posting_date" => $this->posting_date
        ];
    }

    /**
     * Get the id of the job offer.
     * @return int The id of the job offer.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id of the job offer.
     * @param int $ide The id to set.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the title of the job offer.
     * @return string The title of the job offer.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title of the job offer.
     * @param string $title The title to set.
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the description of the job offer.
     * @return string The description of the job offer.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the description of the job offer.
     * @param string $description The description to set.
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get the requirements of the job offer.
     * @return string The requirements of the job offer.
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Set the requirements of the job offer.
     * @param string $requirements The requirements to set.
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }

    /**
     * Get the salary of the job offer.
     * @return float The salary of the job offer.
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set the salary of the job offer.
     * @param float $salary The salary to set.
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * Get the location of the job offer.
     * @return string The location of the job offer.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the location of the job offer.
     * @param string $location The location to set.
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get the posting date of the job offer.
     * @return string The posting date of the job offer in the format YYYY-MM-DD.
     */
    public function getPostingDate()
    {
        return $this->posting_date;
    }

    /**
     * Set the posting date of the job offer.
     * @param string $posting_date The posting date to set in the format YYYY-MM-DD.
     */
    public function setPostingDate($posting_date)
    {
        $this->posting_date = $posting_date;
    }

    /**
     * @return boolean
     */
    public function hasError($field)
    {
        return !empty($this->errors[$field]);
    }

    /**
     * @return array
     */
    public function getError($field)
    {
        return $this->errors[$field];
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
