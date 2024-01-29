<?php
// list die Daten ein
function read_data(string $path = "data.json") {
    $data = file_get_contents($path);
    return json_decode($data, true);
}

// parses data from json to Question objects
function parse_data($data) : array {
    require_once "question.php";
    // map ueber alle Fragen und erstelle ein Question Objekt
    return array_map(function($question) {
        return Question::fromJsonArr($question);
    }, $data);
    // kann man auch mit einem simple for-loop machen
    // foreach ($data as $question) {
    //     $questions[] = Question::fromJsonArr($question);
    // }
    // return $questions;
}