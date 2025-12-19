<?php
// Include database connection
include "../Database/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $reviewId = $_POST['reviewId'];
    $replyText = $_POST['replyText'];

    // Use prepared statements to update the database
    $query = "UPDATE tbl_reviews 
              SET reply_text = ?
              WHERE review_id = ?";

    $stmt = $connection->prepare($query);

    // Bind parameters to the statement
    $stmt->bind_param(
        'si',
        $replyText,
        $reviewId
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
                alert('Reply sent successfully!');
                window.location.href = 'admin-index.php?page=admin-reviews';
              </script>";
    } else {
        echo "<script>
                alert('An error occurred while replying. Please try again.');
                window.location.href = 'admin-index.php?page=admin-reviews';
              </script>";
    }

    $stmt->close();
}

?>