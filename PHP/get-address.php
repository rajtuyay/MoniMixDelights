<?php
session_start();
include "../Database/db.php";

// Check if address_id is provided in the request
if (isset($_POST['address_id'])) {
    $address_id = $_POST['address_id'];

    // Fetch the address data from the database
    $query = "SELECT * FROM tbl_addresses WHERE address_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $address_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the address is found
    if ($row = mysqli_fetch_assoc($result)) {
        // Return the address data as JSON
        echo json_encode([
            'success' => true,
            'address_id' => $row['address_id'],
            'recipient_name' => $row['recipient_name'],
            'street' => $row['street'],
            'province' => $row['province'],
            'city' => $row['city'],
            'barangay' => $row['barangay'],
            'addInfo' => $row['xtra_info'],
            'phone_number' => $row['phone_number']
        ]);
    } else {
        // Return an error if address is not found
        echo json_encode(['success' => false]);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
