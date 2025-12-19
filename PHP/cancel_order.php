<?php
session_start(); // Start the session if not already started

header('Content-Type: application/json'); // Set the correct content type for JSON response

// Ensure database connection is established
include('../Database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $order_id = $input['order_id'];
        $user_id = $_SESSION['user']; // Ensure user ID is correctly retrieved from session

        $querybtncancel = "UPDATE tbl_orders SET status = 'Cancelled' WHERE order_id = '$order_id' AND user_id = '$user_id'";

        if (mysqli_query($connection, $querybtncancel)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($connection)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
