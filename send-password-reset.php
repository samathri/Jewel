<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        // Generate a secure random token
        $token = bin2hex(random_bytes(16));

        // Hash the token to store in the database
        $token_hash = hash("sha256", $token);

        // Set the token expiry time (30 minutes)
        $expiry = date("Y-m-d H:i:s", time() + 30 * 60); // 30 minutes from now

        // Include the database connection
        $mysqli = require __DIR__ . "/php/db.php";

        // Prepare SQL query to update the user table with the reset token and expiry
        $sql = "UPDATE user
                SET reset_token_hash = ?,
                    reset_token_expires_at = ?
                WHERE email = ?";

        $stmt = $mysqli->prepare($sql);

        // Bind parameters (hash, expiry, email)
        $stmt->bind_param("sss", $token_hash, $expiry, $email);

        // Execute the query
        if ($stmt->execute()) {
            // Include PHPMailer and set up email
            $mail = require __DIR__ . "/mailer.php";  // Corrected path to mailer.php
            
            $mail->setFrom("noreply@example.com", "Example");
            $mail->addAddress($email); // The recipient's email
            $mail->Subject = "Password Reset";
            
            // Prepare the email body with the reset link
            $mail->Body = <<<END
            Click <a href="http://localhost/Serandi/Serandi%202/reset-password.php?token=$token">here</a>
            to reset your password.
            END;

            try {
                // Try to send the email
                $mail->send();
                echo json_encode(['status' => 'success', 'message' => 'Message sent, please check your inbox.']);
            } catch (Exception $e) {
                // If the message could not be sent, output the error message
                echo json_encode(['status' => 'error', 'message' => 'Message could not be sent. Mailer error: ' . $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No user found with that email address.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
    }
}
?>
