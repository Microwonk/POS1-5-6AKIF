<?php

require_once "DatabaseObject.php";

class Credentials implements DatabaseObject
{
    private $id = 0;
    private $name = '';
    private $domain = '';
    private $cms_username = '';
    private $cms_password = '';

    private $errors = [];

    public function validate()
    {
        return $this->validateHelper('Name', 'name', $this->name, 32) &
            $this->validateHelper('Domäne', 'domain', $this->domain, 128) &
            $this->validateHelper('CMS-Benutzername', 'cms_username', $this->cms_username, 64) &
            $this->validateHelper('CMS-Passwort', 'cms_password', $this->cms_password, 64);
    }

    /**
     * create or update an object
     * @return boolean true on success
     */
    public function save()
    {
        if ($this->validate()) {
            if ($this->id != null && $this->id > 0) {
                // known ID > 0 -> old object -> update
                $this->update();
            } else {
                // undefined ID -> new object -> create
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
        $db = Database::connect();
        $sql = "INSERT INTO credentials (name, domain, cms_username, cms_password) values(?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->domain, $this->cms_username, $this->cms_password));
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();
        return $lastId;
    }

    /**
     * Saves the object to the database
     */
    public function update()
    {
        $db = Database::connect();
        $sql = "UPDATE credentials set name = ?, domain = ?, cms_username = ?, cms_password = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->domain, $this->cms_username, $this->cms_password, $this->id));
        Database::disconnect();


        /*
        // SQL Injection

        ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

        $db = Database::connect();
        $sql = "UPDATE credentials set name = ?, domain = " . $this->domain . ", cms_username = ?, cms_password = ? WHERE id = ?";

        // SQL-Befehl:   'shareasale.com'; DROP TABLE credentials;

        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->cms_username, $this->cms_password, $this->id));
        Database::disconnect();
        */
    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object
     */
    public static function get($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM credentials WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $item = $stmt->fetchObject('Credentials');
        Database::disconnect();

        return $item !== false ? $item : null;
    }

    /**
     * Get an array of objects from database
     * @return array array of objects
     */
    public static function getAll()
    {
        $credentials = [];
        $db = Database::connect();
        $sql = 'SELECT * FROM credentials ORDER BY name ASC, domain ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // fetch all datasets (rows), convert to array of Credentials-objects (ORM)
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Credentials');
        Database::disconnect();

        return $items;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id)
    {
        $db = Database::connect();
        $sql = "DELETE FROM credentials WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }

    /**
     * helper method for validating strings
     * @param $label used in error message
     * @param $key identification for array element
     * @param $value gonna checked
     * @param $maxLength used for value checking
     * @return boolean true if value is valid, else false
     */
    private function validateHelper($label, $key, $value, $maxLength)
    {
        if (strlen($value) == 0) {
            $this->errors[$key] = "$label darf nicht leer sein";
            return false;
        } else if (strlen($value) > $maxLength) {
            $this->errors[$key] = "$label zu lang (max. $maxLength Zeichen)";
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getCmsUsername()
    {
        return $this->cms_username;
    }

    /**
     * @return string
     */
    public function getCmsPassword()
    {
        return $this->cms_password;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @param string $cms_username
     */
    public function setCmsUsername($cms_username)
    {
        $this->cms_username = $cms_username;
    }

    /**
     * @param string $cms_password
     */
    public function setCmsPassword($cms_password)
    {
        $this->cms_password = $cms_password;
    }



}
