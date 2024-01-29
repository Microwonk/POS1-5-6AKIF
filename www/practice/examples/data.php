<?php


// HashMap<String, Any>
// map.get('name');
$data = [
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'johndoe@example.com',
    'city' => 'New York',
    'department' => [
        'name' => "wadsdadw",
        'id' => 123
    ]
];

// array
echo $data['department']['name'];
$obj_data = json_decode($json_string, false);
$obj_data->department->name;

