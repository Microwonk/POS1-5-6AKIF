<?php
function read_data() {
    $data = file_get_contents("data.json");
    return json_decode($data, true);
}

function parse_data($data) : array {
    require_once "question.php";
    $questions = [];
    foreach ($data as $question) {
        $questions[] = new Question($question["question"], $question["id"], $question["options"]);
    }
    return $questions;
}