<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize error message
    $error_message = '';

    // Ensure the token is provided
    if (!isset($_POST["token"])) {
        $error_message = "Token not provided.";
    } else {
        $token = $_POST["token"];  // Get the token from the form
        $token_hash = hash("sha256", $token);  // Hash the token to compare it securely

        // Include the database connection file
        $mysqli = require __DIR__ . "/php/db.php";

        // Prepare SQL statement to find user by hashed reset token
        $sql = "SELECT * FROM user WHERE reset_token_hash = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            $error_message = "Error preparing statement: " . $mysqli->error;
        } else {
            // Bind the hashed token to the prepared statement
            $stmt->bind_param("s", $token_hash);

            // Execute the query
            $stmt->execute();

            // Get the result of the query
            $result = $stmt->get_result();

            // Fetch the user details
            $user = $result->fetch_assoc();

            // Check if the user exists
            if ($user === null) {
                $error_message = "Token not found.";
            }

            // Check if the reset token has expired
            if (strtotime($user["reset_token_expires_at"]) <= time()) {
                $error_message = "Token has expired.";
            }

            // Validate password
            if (strlen($_POST["password"]) < 8) {
                $error_message = "Password must be at least 8 characters.";
            }

            if (!preg_match("/[a-z]/i", $_POST["password"])) {
                $error_message = "Password must contain at least one letter.";
            }

            if (!preg_match("/[0-9]/i", $_POST["password"])) {
                $error_message = "Password must contain at least one number.";
            }

            if ($_POST["password"] !== $_POST["password_confirmation"]) {
                $error_message = "Passwords must match.";
            }

            // If no errors, proceed to update the password
            if (empty($error_message)) {
                // Hash the new password
                $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

                // Prepare the SQL query to update the user's password
                $sql = "UPDATE user
                        SET password_hash = ?, 
                            reset_token_hash = NULL, 
                            reset_token_expires_at = NULL
                        WHERE id = ?";

                $stmt = $mysqli->prepare($sql);

                // Bind the new password hash and user ID
                $stmt->bind_param("si", $password_hash, $user["id"]);

                // Execute the query to update the password
                if ($stmt->execute()) {
                    // Success: Redirect with a success message
                    header("Location: success.php");
                    exit();
                } else {
                    $error_message = "Failed to update password.";
                }
            }
        }
    }

    // If there's an error, output it in an alert and redirect back to the reset password page
    if (!empty($error_message)) {
        echo "<script>
                alert('$error_message');
                window.location.href = 'reset-password.php'; // Replace with your reset password page URL
              </script>";
    }
}
?>
