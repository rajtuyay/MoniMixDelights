<?php
// Include database connection
include "../Database/db.php";

// Check if the productId is passed via POST
if (isset($_POST['reviewId'])) {
    $reviewId = $_POST['reviewId']; // Get the product ID from the POST data

    // Step 3: Delete the product from the database
    $query2 = "DELETE FROM tbl_reviews WHERE review_id = ?";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param('i', $reviewId);

    if ($stmt2->execute()) {
        echo "<script>
                alert('Review deleted successfully!');
                window.location.href = 'admin-index.php?page=admin-reviews'; // Redirect to the products page
              </script>";
    } else {
        echo "<script>
                alert('An error occurred while deleting the review. Please try again.');
                window.location.href = 'admin-index.php?page=admin-reviews'; // Redirect back to the products page
              </script>";
    }

    $stmt2->close();
} else {
    // If no productId is provided in the POST data
    echo "<script>
            alert('Invalid review ID. Unable to delete the review.');
            window.location.href = 'admin-index.php?page=admin-reviews'; // Redirect back to the products page
          </script>";
}
?>