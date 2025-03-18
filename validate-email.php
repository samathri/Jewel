<?php

$mysqli = require __DIR__ . "php/db.php";

$sql = sprintf("SELECT*FROM user
                WHERE email = '%$'",
                $mysqli->real_escape_string ($_GET ["email"]));

$result = $mysqli->query($sql);

$is_available = $result->num_rows === 0;

header("content-type: application/json");

echo json_encode(["available" ==> $ is_available]);