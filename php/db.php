<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serendi_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn; // Return the connection object for use in other scripts

?>



