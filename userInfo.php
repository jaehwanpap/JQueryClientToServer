<?php
header('Content-Type: application/json');

$users = [
    ["name" => "Jaehwan", "age" => 10],
    ["name" => "prosper", "age" => 20],
    ["name" => "jordan", "age" => 30],
    ["name" => "oscar", "age" => 0],
];

echo json_encode($users);
?>