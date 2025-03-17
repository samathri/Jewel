<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
   

    // Insert data into the database
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "<script>alert('Your Message successful'); window.location.href = '/Serandi/Serandi 2/home.php';</script>";
    } else {
        // Registration failed
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>