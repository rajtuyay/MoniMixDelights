<?php
session_start();
include "../Database/db.php";

// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated address data from the request
    $id = $_POST['addressId'];
    $recipient_name = $_POST['name'];
    $street = $_POST['street'];
    $xtra = $_POST['xtra_info'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $contact = $_POST['contact'];

    // Prepare the SQL query to update the address in the database
    $query = "UPDATE tbl_addresses 
              SET recipient_name = ?, street = ?, province = ?, city = ?, barangay = ?, phone_number = ? 
              WHERE address_id = ?";
    
    $stmt = mysqli_prepare($connection, $query);
    
    // Bind the parameters to prevent SQL injection
    mysqli_stmt_bind_param($stmt, 'ssssssi', $recipient_name, $street, $province, $city, $barangay, $contact, $id);
    
    // Execute the query and check if the update was successful
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Address updated successfully'); window.location.href = 'profile.php?page=addresses';</script>";
    } else {
        echo "<script>alert('Failed to update address. Please try again.'); window.location.href = 'profile.php?page=addresses';</script>";
    }
    
    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>
