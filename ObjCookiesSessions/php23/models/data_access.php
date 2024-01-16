<?php
function getAllBooks() : array {
    $data = file_get_contents("data/PHP-23 bookdata.json");
    return json_decode($data,true);
}