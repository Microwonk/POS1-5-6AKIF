<?php

require_once("DatabaseObject.php");
require_once("JobOffer.php");

class Applicant implements DatabaseObject, JsonSerializable
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $phone;
    private $resume;
    private string $application_date;
    private int $joboffer_id;
    private ?JobOffer $jobOffer = null;
    private array $errors = [];


    //Teil B: Befüllen Sie  die CRUD-Methoden nach ORM-Pattern für den DB-Zugriff und erstellen Sie die Methode save() laut Angabe

    public function save(): bool {
        if ($this->validate()) {
            if ($this->id && $this->id != 0) {
                $this->update();
            } else {
                $this->id = $this->create();
            }
            return true;
        }
        return false;
    }

    public static function getAll(): array
    {
        $sql = "SELECT * FROM applicants";
        $db = Database::get();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function get($id): ?static
    {
        $sql = "SELECT * FROM applicants WHERE id = ?";
        $db = Database::get();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(self::class);
    }

    public function create()
    {
        $sql = "INSERT INTO applicants (first_name, last_name, email, phone, resume, application_date, joboffer_id) values (?, ?, ?, ?, ?, ?, ?)";
        $db = Database::get();
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->first_name, $this->last_name, $this->email, $this->phone, $this->resume, $this->application_date, $this->joboffer_id]);
        return $db->lastInsertId();
    }

    public function update(): bool
    {
        $sql = "UPDATE applicants set first_name = ?, set last_name = ?, set email = ?, set phone = ?, set resume = ?, set application_date = ?, set joboffer_id = ?";
        $db = Database::get();
        $stmt = $db->prepare($sql);
        return $stmt->execute([$this->first_name, $this->last_name, $this->email, $this->phone, $this->resume, $this->application_date, $this->joboffer_id]);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM applicants WHERE id = ?";
        $db = Database::get();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
    }


    public function validate()
    {
        return $this->validateFirstName() & 
               $this->validateLastName() & 
               $this->validateEmail() & 
               $this->validatePhone() & 
               $this->validateResume() & 
               $this->validateApplicationDate() & 
               $this->validateJobOfferId();
    }

    public function validateFirstName()
    {
        if (!is_string($this->first_name) || empty($this->first_name)) {
            $errors['first_name'] = "Der Vorname muss eine nicht-leere Zeichenfolge sein.";
            return false;
        } else {
            unset($this->errors['first_name']);
            return true;
        }
    }

    public function validateLastName()
    {
        if (!is_string($this->last_name) || empty($this->last_name)) {
            $errors['last_name'] = "Der Nachname muss eine nicht-leere Zeichenfolge sein.";
            return false;
        } else {
            unset($this->errors['last_name']);
            return true;
        }
    }

    public function validateEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Ungültige E-Mail.";
            return false;
        } else {
            unset($this->errors['email']);
            return true;
        }
    }

    public function validatePhone()
    {
        // Remove non-digit characters from the phone number
        $phone = preg_replace('/\D/', '', $this->phone);
        if (!preg_match('/^\d{10,}$/', $phone)) {
            $errors['phone'] = "Ungültige Telefonnummer.";
            return false;
        } else {
            unset($this->errors['phone']);
            return true;
        }
    }

    public function validateResume()
    {
        if (!is_string($this->resume) || empty($this->resume)) {
            $errors['resume'] = "Keine Lebenslauf hochgeladen.";
            return false;
        } else {
            unset($this->errors['resume']);
            return true;
        }
    }

    public function validateApplicationDate()
    {
        // Validate the date format (YYYY-MM-DD)
        $date = DateTime::createFromFormat('Y-m-d', $this->application_date);
        $errors = DateTime::getLastErrors();
        if (!$date || $errors['warning_count'] || $errors['error_count']) {
            $errors['application_date'] = "Ungültiges Datumsformat. Bitte verwenden Sie JJJJ-MM-TT";
            return false;
        } else {
            unset($this->errors['application_date']);
            return true;
        }
    }

    private function validateJobOfferId()
    {
        if (!is_numeric($this->joboffer_id) && $this->joboffer_id <= 0) {
            $this->errors['joboffer_id'] = "JobOfferID ungueltig";
            return false;
        } else {
            unset($this->errors['joboffer_id']);
            return true;
        }
    }


    public function jsonSerialize(): mixed
    {
        $data = [
            "id" => intval($this->id),
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "application_date" => $this->application_date,
        ];

        if ($this->joboffer_id != null && is_numeric($this->joboffer_id)) {
            $data['joboffer_id'] = intval($this->joboffer_id);      // include id
        }

        if ($this->jobOffer != null && is_object($this->jobOffer)) {
            $data['jobOffer'] = $this->jobOffer;      // include object
        }

        return $data;
    }

        /**
     * Get the id of the applicant.
     * @return int The id of the applicant.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id of the applicant.
     * @param int $id The id to set.
     */
    public function setId($id)
    {
        if ($id != null && $id > 0)
            $this->id = $id;
    }

    /**
     * Get the first name of the applicant.
     * @return string The first name of the applicant.
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the first name of the applicant.
     * @param string $first_name The first name to set.
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * Get the last name of the applicant.
     * @return string The last name of the applicant.
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the last name of the applicant.
     * @param string $last_name The last name to set.
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * Get the email of the applicant.
     * @return string The email of the applicant.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email of the applicant.
     * @param string $email The email to set.
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the phone number of the applicant.
     * @return string The phone number of the applicant.
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the phone number of the applicant.
     * @param string $phone The phone number to set.
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get the resume of the applicant.
     * @return string The resume of the applicant.
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the resume of the applicant.
     * @param string $resume The resume to set.
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * Get the application date of the applicant.
     * @return string The application date of the applicant in the format YYYY-MM-DD.
     */
    public function getApplicationDate()
    {
        return $this->application_date;
    }

    /**
     * Set the application date of the applicant.
     * @param string $application_date The application date to set in the format YYYY-MM-DD.
     */
    public function setApplicationDate($application_date)
    {
        $this->application_date = $application_date;
    }

    /**
     * Get the job offer id of the applicant.
     * @return int JobOffer_id The job offer id of the applicant.
     */
    public function getJobOfferId()
    {
        return $this->joboffer_id;
    }

    /**
     * Set the job offer id of the applicant.
     * @param int $joboffer_id The job offer to set.
     */
    public function setJobOfferId($joboffer_id)
    {
        $this->joboffer_id = $joboffer_id;
    }

    /**
     * Get the job offer of the applicant.
     * @return $jobOffer The job offer of the applicant.
     */
    public function getJobOffer()
    {
        if ($this->jobOffer == null) {
            $db = Database::get();
            $stmt = $db->prepare("SELECT * FROM joboffers WHERE id = ?");
            $stmt->execute([$this->getJobOfferId()]);
            $this->jobOffer = $stmt->fetchObject(JobOffer::class);
        }
        return $this->jobOffer;
    }

    /**
     * Set the job offer of the applicant.
     * @param string $jobOffer The job offer to set.
     */
    public function setJobOffer($jobOffer)
    {
        $this->jobOffer = $jobOffer;
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
