<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Database connection
$mysqli = new mysqli("localhost", "root", "", "serendi_project"); // Update these credentials

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch current user data from the database
$query = "SELECT name, email FROM user WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $new_name = htmlspecialchars($_POST['name']);
    $new_email = htmlspecialchars($_POST['email']);
    $new_password = $_POST['password'];
    $new_password_confirmation = $_POST['password_confirmation'];

    // Validate input
    if (empty($new_name) || empty($new_email)) {
        $error_message = "Name and email are required.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif ($new_password !== $new_password_confirmation) {
        $error_message = "Passwords do not match.";
    } elseif (strlen($new_password) > 0 && strlen($new_password) < 8) {
        $error_message = "Password must be at least 8 characters.";
    } elseif (strlen($new_password) > 0 && !preg_match("/[a-z]/i", $new_password)) {
        $error_message = "Password must contain at least one letter.";
    } elseif (strlen($new_password) > 0 && !preg_match("/[0-9]/i", $new_password)) {
        $error_message = "Password must contain at least one number.";
    }

    // If no validation errors
    if (!isset($error_message)) {
        // Update user information in the database
        $update_query = "UPDATE user SET name = ?, email = ? WHERE id = ?";
        $stmt = $mysqli->prepare($update_query);
        $stmt->bind_param("ssi", $new_name, $new_email, $user_id);

        if ($stmt->execute()) {
            // If password is provided, update it as well
            if (!empty($new_password)) {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password_query = "UPDATE user SET password_hash = ? WHERE id = ?";
                $stmt = $mysqli->prepare($update_password_query);
                $stmt->bind_param("si", $password_hash, $user_id);
                $stmt->execute();
            }
            // Redirect to the profile page with success message
            header("Location: edit-profile.php?status=success");
            exit;
        } else {
            $error_message = "Error updating profile: " . $mysqli->error;
        }
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include your CSS file here -->
</head>
<body>
    <div class="container my-5">
        <div class="title-with-lines">
            <div class="line"></div>
            <h1>Edit Profile</h1>
            <div class="line"></div>
        </div>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="sign-up-form text-center p-4">
                <form action="edit-profile.php" method="post" id="edit-profile" novalidate>
                    <?php
                    if (isset($error_message)) {
                        echo "<div class='alert alert-danger'>{$error_message}</div>";
                    }
                    if (isset($_GET['status']) && $_GET['status'] == 'success') {
                        echo "<div class='alert alert-success'>Profile updated successfully.</div>";
                    }
                    ?>
                    <div class="form-container">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password">
                        </div>
                        <button type="submit" class="btn btn-register">Update Profile</button>
                    </div>
                </form>
                <div class="login-link">
                    <p><a href="profile.php" class="login-text">Back to Profile</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
