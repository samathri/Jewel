<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/forgot-password.css">
    <style>
      /* Remove border-radius from the modal */
      .modal-content {
        border-radius: 0 !important;
      }

      /* Center the message inside the modal */
      .modal-body {
        text-align: center;
        font-size: 1.2em;
      }

      /* Remove the header and footer lines */
      .modal-header,
      .modal-footer {
        display: none;
      }
    </style>
  </head>
  <body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="reset-password-form text-center">
        <h1>Verify Email Address</h1>
        <br><br>
        <p>Enter your email to receive a password reset link.</p>

        <!-- Form for Email Submission -->
        <form id="emailForm" method="post">
          <div class="mb-3">
            <input
              type="email"
              name="email"
              class="form-control"
              id="email"
              placeholder="Enter your email"
              required
            />
          </div>
          <button type="submit" class="btn btn-dark">Send Reset Link</button>

          <p class="mt-3">
            If you don’t need to reset your password, go to the <a href="login.php" class="login-link">Login page</a>.
          </p>
        </form>
      </div>
    </div>

    <!-- Bootstrap Modal for displaying messages -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" id="modalBody">
            <!-- Message will be inserted here -->
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // JavaScript to handle form submission and display the response
      const form = document.getElementById('emailForm');
      form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting normally

        const formData = new FormData(form);

        // Send the form data using Fetch API
        fetch('send-password-reset.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          const status = data.status;
          const message = data.message;
          
          // Set the modal message
          document.getElementById('modalBody').innerText = message;

          // Show the modal with the message
          var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
          myModal.show();
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });
    </script>

  </body>
</html>
