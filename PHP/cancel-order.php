<?php
// Include database connection
include "../Database/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $status = "Cancelled";
    $orderId = $_POST['orderId'];
    // Use prepared statements to update the database
    $query = "UPDATE tbl_orders 
              SET status = ?
              WHERE order_id = ?";

    $stmt = $connection->prepare($query);

    // Bind parameters to the statement
    $stmt->bind_param(
        'si',
        $status,
        $orderId
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
                alert('Product cancelled successfully!');
                window.location.href = 'admin-index.php?page=admin-pending';
              </script>";
    } else {
        echo "<script>
                alert('An error occurred while updating the status. Please try again.');
                window.location.href = 'admin-index.php?page=admin-pending';
              </script>";
    }

    $stmt->close();
}

?>