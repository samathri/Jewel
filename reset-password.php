<?php
// Ensure the token is provided in the query string
if (!isset($_GET["token"])) {
    die("Token not provided.");
}

$token = $_GET["token"];
error_log("Received token: " . $token);  // Log the token for debugging


// Hash the token to compare it securely
$token_hash = hash("sha256", $token);

// Include database connection file
$mysqli = require __DIR__ . "/php/db.php";

// Prepare SQL statement to find user by hashed reset token
$sql = "SELECT * FROM user WHERE reset_token_hash = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $token_hash);  // Bind the hashed token
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


if ($stmt === false) {
    die("Error preparing statement: " . $mysqli->error);
}

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
    die("Token not found.");
}

// Check if the reset token has expired
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Add FontAwesome CDN for eye icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset-password.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <script src="js/validation.js" defer></script>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="reset-password-form text-center">
      <h1>Reset account password</h1>
      <br><br>

      <form method="post" action="process-reset-password.php" id="resetForm">
        <div class="mb-3 position-relative">
          <!-- Hidden token field -->
          <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="New Password"
            required
          />
          <!-- Show/Hide icon for the password -->
          <span class="eye-icon" id="togglePassword">
            <i class="fas fa-eye-slash" id="eyeIcon"></i>
          </span>
        </div>

        <div class="mb-3 position-relative">
          <input
            type="password"
            class="form-control"
            id="confirmPassword"
            name="password_confirmation" 
            placeholder="Confirm password"
            required
          />
          <!-- Show/Hide icon for confirm password -->
          <span class="eye-icon" id="toggleConfirmPassword">
            <i class="fas fa-eye-slash" id="eyeIconConfirm"></i>
          </span>
        </div>

        <button type="submit" class="btn btn-dark w-100">Reset password</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // JavaScript to toggle password visibility for the New Password field
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function () {
      // Toggle the type attribute to show or hide the password
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;

      // Toggle the eye icon between open and closed
      eyeIcon.classList.toggle('fa-eye');
      eyeIcon.classList.toggle('fa-eye-slash');
    });

    // JavaScript to toggle password visibility for the Confirm Password field
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPasswordField = document.querySelector('#confirmPassword');
    const eyeIconConfirm = document.querySelector('#eyeIconConfirm');

    toggleConfirmPassword.addEventListener('click', function () {
      // Toggle the type attribute for confirm password
      const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
      confirmPasswordField.type = type;

      // Toggle the eye icon for confirm password
      eyeIconConfirm.classList.toggle('fa-eye');
      eyeIconConfirm.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>
