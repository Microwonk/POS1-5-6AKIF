<?php

$name = htmlspecialchars(issetor("name"));
$email = htmlspecialchars(issetor("mail"));

echo "Given name: ". $name . ", Given email: ". $email;

function issetor(string $var, mixed $default = "default") : mixed {
    return isset($_POST[$var]) ? $_POST[$var] : $default;
}

?>