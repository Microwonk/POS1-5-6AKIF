<?php

$errors = [];

function calculateBMI(float $height, float $weight): array {
    if ($height > 3) {
        $height = $height / 100; // Convert from centimeters to meters
    }
    $bmi = $weight / ($height * $height);
    return [$bmi, stringifyBMI($bmi)];
}

function stringifyBMI(float $bmi) : string {
    return match (true) {
        $bmi < UNDERWEIGHT => "Untergewicht",
        $bmi <= NORMAL => "Normalgewicht",
        $bmi <= OVERWEIGHT => "Übergewicht",
        $bmi > OVERWEIGHT => "Adipositas",
        default => "Invalider BMI"
    };
}


function validate(string $name, $date, string $height, string $weight) : bool {
    return validateName($name) & validateDate($date) &
        validateHeight($height) & validateWeight($weight);
}

function validateName($name) : bool {
    global $errors;

    if (strlen($name) == 0) {
        $errors[NAME] = "Name darf nicht leer sein";
        return false;
    } else if (strlen($name) > 25) {
        $errors[NAME] = "Name zu lang";
        return false;
    } else {
        return true;
    }
}

function validateWeight($weight) : bool {
    global $errors;

    if (!is_numeric($weight) && ($weight <= 0 || $weight >= 1000)) {
        $errors[HEIGHT] = "Gewicht ungültig";
        return false;
    } else {
        return true;
    }
}

function validateHeight($height) : bool {
    global $errors;

    if (!is_numeric($height) && ($height <= 0 || $height >= 1000)) {
        $errors[HEIGHT] = "Größe ungültig";
        return false;
    } else {
        return true;
    }
}

function validateDate($date) : bool {
    global $errors;

    try {
        if ($date == "") {
            $errors[DATE] = "Datum darf nicht leer sein";
            return false;
        } else if (new DateTime($date) > new DateTime()) {
            $errors[DATE] = "Datum darf nicht in der Zukunft liegen";
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        $errors[DATE] = "Datum ungültig";
        return false;
    }
}