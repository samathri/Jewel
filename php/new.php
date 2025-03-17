<html>
    <head>
        <title>
</title>
</head>
<body>
    <h1>Reveiw</h1>
    <?php
if (isset($_GET['id'])) {
    $review_id = intval($_GET['id']); // Sanitize the input
    require 'db.php'; // Include your database connection

    $sql = "SELECT * FROM review WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $review_id); // Bind the review ID
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $review = $result->fetch_assoc();
            echo "<h1>Review Details</h1>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($review['name']) . "</p>";
            echo "<p><strong>Review:</strong> " . htmlspecialchars($review['review']) . "</p>";
            echo "<p><strong>Rating:</strong> " . htmlspecialchars($review['rating']) . "</p>";
        } else {
            echo "<p>No review found.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error preparing query: " . $conn->error . "</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>

</body>
</html>