<?php

require_once 'Database.php';

interface DatabaseObject
{
    /**
     * Inserts an existing php-object into the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function insert();

    /**
     * Update an existing object into the database
     * @return boolean true on success
     */
    public function update();

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id);

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll();

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id);
}