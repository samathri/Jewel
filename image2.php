<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$mysqli = new mysqli("localhost", "root", "", "serendi_project");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch current user data
$query = "SELECT name, email, profile_picture FROM user WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $profile_picture);
$stmt->fetch();
$stmt->close();

// Initialize messages
$error_message = '';
$success_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form submission is for deleting the image
    if (isset($_POST['action']) && $_POST['action'] === 'delete_image') {
        if ($profile_picture && file_exists("uploads/{$profile_picture}")) {
            if (unlink("uploads/{$profile_picture}")) { // Delete the image from the server
                $update_query = "UPDATE user SET profile_picture = NULL WHERE id = ?";
                $stmt = $mysqli->prepare($update_query);
                $stmt->bind_param("i", $user_id);
                if ($stmt->execute()) {
                    $success_message = "Profile image deleted successfully.";
                    $profile_picture = null; // Update variable
                } else {
                    $error_message = "Error updating profile picture in the database.";
                }
                $stmt->close();
            } else {
                $error_message = "Error deleting the profile image from the server.";
            }
        } else {
            $error_message = "No profile image found to delete.";
        }
    } else {
        // Handle profile update
        $new_name = htmlspecialchars(trim($_POST['name']));
        $new_email = htmlspecialchars(trim($_POST['email']));
        $new_password = $_POST['password'] ?? '';
        $new_password_confirmation = $_POST['password_confirmation'] ?? '';

        // Validate inputs
        if (empty($new_name) || empty($new_email)) {
            $error_message = "Name and email are required.";
        } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format.";
        } elseif ($new_password !== $new_password_confirmation) {
            $error_message = "Passwords do not match.";
        } elseif (!empty($new_password) && strlen($new_password) < 8) {
            $error_message = "Password must be at least 8 characters.";
        }

        // Handle image upload
        $uploaded_image = null;
        if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] === 0) {
            $file_name = $_FILES["profile_image"]["name"];
            $file_tmp_name = $_FILES["profile_image"]["tmp_name"];
            $file_size = $_FILES["profile_image"]["size"];
            $file_type = mime_content_type($file_tmp_name);
            $allowed_types = ["image/jpeg", "image/png", "image/gif"];

            if (in_array($file_type, $allowed_types) && $file_size <= 5 * 1024 * 1024) {
                $unique_name = uniqid() . "-" . basename($file_name);
                $target_dir = "uploads/";
                $target_file = $target_dir . $unique_name;

                if (move_uploaded_file($file_tmp_name, $target_file)) {
                    $uploaded_image = $unique_name;

                    // Delete old image if exists
                    if ($profile_picture && file_exists("uploads/{$profile_picture}")) {
                        unlink("uploads/{$profile_picture}");
                    }
                } else {
                    $error_message = "Error uploading new profile image.";
                }
            } else {
                $error_message = "Invalid file type or size exceeds 5MB.";
            }
        }

        // Proceed to update user details
        if (empty($error_message)) {
            $mysqli->begin_transaction();
            try {
                // Update name and email
                $update_query = "UPDATE user SET name = ?, email = ? WHERE id = ?";
                $stmt = $mysqli->prepare($update_query);
                $stmt->bind_param("ssi", $new_name, $new_email, $user_id);
                $stmt->execute();
                $stmt->close();

                // Update password if provided
                if (!empty($new_password)) {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_password_query = "UPDATE user SET password_hash = ? WHERE id = ?";
                    $stmt = $mysqli->prepare($update_password_query);
                    $stmt->bind_param("si", $password_hash, $user_id);
                    $stmt->execute();
                    $stmt->close();
                }

                // Update profile image if uploaded
                if ($uploaded_image !== null) {
                    $update_image_query = "UPDATE user SET profile_picture = ? WHERE id = ?";
                    $stmt = $mysqli->prepare($update_image_query);
                    $stmt->bind_param("si", $uploaded_image, $user_id);
                    $stmt->execute();
                    $stmt->close();
                }

                $mysqli->commit();
                $success_message = "Profile updated successfully.";
            } catch (Exception $e) {
                $mysqli->rollback();
                $error_message = "Error updating profile: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .profile-form { max-width: 500px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        .message { text-align: center; margin-bottom: 20px; font-weight: bold; }
        .message.success { color: green; }
        .message.error { color: red; }
    </style>
</head>
<body>
    <?php if ($error_message): ?>
        <div class="message error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <div class="message success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form action="image2.php" method="post" enctype="multipart/form-data" class="profile-form">
        
    <h2>Edit Profile</h2>
    <?php if ($profile_picture): ?>
            <div class="form-group">
                <label>Current Profile Picture:</label>
                <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="150"><br>
               
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="profile_image">Upload New Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image">
        </div>


        
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="form-group">
            <button type="submit" name="action" value="update_profile">Update Profile</button>
        </div>
    </form>
</body>
</html>
