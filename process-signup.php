<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store error messages
    $errorMessages = [];

    // Validate and sanitize input
    if (empty($_POST["name"])) {
        $errorMessages[] = "Name is required.";
    }
    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Valid email is required.";
    }
    if (strlen($_POST["password"]) < 8) {
        $errorMessages[] = "Password must be at least 8 characters.";
    }
    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errorMessages[] = "Password must contain at least one letter.";
    }
    if (!preg_match("/[0-9]/i", $_POST["password"])) {
        $errorMessages[] = "Password must contain at least one number.";
    }
    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        $errorMessages[] = "Passwords must match.";
    }

    // If there are errors, show them in an alert box
    if (!empty($errorMessages)) {
        // Convert error messages to a single string with line breaks
        $errorString = implode("\\n", $errorMessages);
        echo "<script>alert('$errorString');</script>";
    } else {
        // Sanitize and hash the password
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);

        // Database connection
        $mysqli = new mysqli("localhost", "root", "", "serendi_project"); // Update these credentials

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Check if the email is already taken
        $email_check_query = "SELECT id FROM user WHERE email = ?";
        $stmt_check = $mysqli->prepare($email_check_query);
        if ($stmt_check === false) {
            die("SQL error: " . $mysqli->error);
        }
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        // If the email already exists
        if ($stmt_check->num_rows > 0) {
            echo "<script>alert('Email is already taken.');</script>";
            exit;
        }

        // Prepare SQL statement for inserting user
        $sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("SQL error: " . $mysqli->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("sss", $name, $email, $password_hash);

        // Execute the query
        if ($stmt->execute()) {
            // After the user clicks OK, stay on the same page with a success message
            header("Location: signup.php?signup=success"); // Reload the page with the success message
            exit;
        } else {
            // Handle errors
            echo "<script>alert('Error: " . $mysqli->error . "');</script>";
        }

        // Close the statement and connection
        $stmt->close();
        $mysqli->close();
    }
}
?>
