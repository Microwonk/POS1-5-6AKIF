<?php

require_once 'data.php';

class Person {
    public $name;
    public $age;
    public $email;

    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }

    public static function fromJsonArr(array $arr): Person {
        $name = $arr['name'];
        $age = $arr['age'];
        $email = $arr['email'];
        return new Person($arr['id'], $name, $age, $email);
    }
}


class PersonList {
    private array $persons;

    // singleton pattern
    private static $INSTANCE;
    public static function get(): PersonList {
        if (self::$INSTANCE == null) {
            self::$INSTANCE = new PersonList();
        }
        return self::$INSTANCE;
    }

    private function __construct() {
        // laden das Json, ist noch ein Array
        $this->persons = loadJson();
    }

    public function getPersons(): array {
        return $this->persons;
    }

    public function addPerson(Person $person) {
        $this->persons[] = $person;
    }

    public static function fromJsonArr($arr): PersonList {
        $personList = new PersonList();
        foreach ($arr as $personArr) {
            $person = Person::fromJsonArr($personArr);
            $personList->addPerson($person);
        }
        return $personList;
    }
}

function loadJson(string $filename = "data/data.json"): array {
    // laden content
    $json_data = file_get_contents($filename);
    // umwandeln in Array
    $data_j = json_decode($json_data, false);
    // return array
    return $data_j;
}

var_dump(PersonList::get()->getPersons());