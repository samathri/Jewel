<?php
// Initialize the response variable to avoid undefined variable warning
$response = ["status" => "", "message" => ""];

// Start the session (if you are using sessions)
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "serendi_project");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// File upload handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_image"])) {
    $file = $_FILES["profile_image"];
    $file_name = uniqid() . "-" . basename($file["name"]);
    $target_dir = "uploads/";

    // Validate file type and size
    $allowed_types = ["image/jpeg", "image/png", "image/gif"];
    if (!in_array(mime_content_type($file["tmp_name"]), $allowed_types) || $file["size"] > 5 * 1024 * 1024) {
        $response = ["status" => "error", "message" => "Invalid file type or size too large."];
    } elseif ($file["error"] === 0) {
        // Debugging: Check if file is being uploaded correctly
        echo "<pre>";
        print_r($file);
        echo "</pre>";

        // Check if the upload directory is writable
        if (!is_writable($target_dir)) {
            $response = ["status" => "error", "message" => "Upload directory is not writable."];
        } else {
            // Move file to target directory
            if (move_uploaded_file($file["tmp_name"], $target_dir . $file_name)) {
                // Insert file name into the database
                $stmt = $conn->prepare("UPDATE user SET profile_picture = ? WHERE id = ?");
                $stmt->bind_param("si", $file_name, $_SESSION['user_id']);
                if ($stmt->execute()) {
                    $response = ["status" => "success", "message" => "Profile picture updated successfully."];
                } else {
                    $response = ["status" => "error", "message" => "Database error."];
                }
                $stmt->close();
            } else {
                $response = ["status" => "error", "message" => "File upload failed. Error code: " . $file["error"]];
            }
        }
    } else {
        $response = ["status" => "error", "message" => "Error during file upload. Error code: " . $file["error"]];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Save User</title>
</head>
<body>

    <h2>Upload Profile Image and Save User Data</h2>
    
    <!-- Display the response message -->
    <?php if ($response["status"]): ?>
        <div style="color: <?php echo $response["status"] == 'success' ? 'green' : 'red'; ?>;">
            <?php echo $response["message"]; ?>
        </div>
    <?php endif; ?>

    <!-- Form for uploading image and entering user data -->
    <form method="POST" enctype="multipart/form-data">
        <label for="profile_image">Select Profile Image:</label>
        <input type="file" name="profile_image" id="profile_image" required><br><br>
        
        <button type="submit">Upload and Save</button>
    </form>

</body>
</html>
