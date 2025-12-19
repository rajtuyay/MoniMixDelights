<?php
session_start();
include "../Database/db.php";

// Get the user data from the session and POST request
$user = $_SESSION['user'];
$name = $_POST['name'];
$province = $_POST['province'];
$city = $_POST['city'];
$barangay = $_POST['barangay'];
$street = $_POST['street'];
$addInfo = $_POST['addInfo'];
$contact = $_POST['contact'];

$query = "INSERT INTO tbl_addresses (user_id, recipient_name, province, city, barangay, street, xtra_info, phone_number) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connection, $query);

if ($stmt === false) {
    echo 'Failed to prepare the query.';
    exit;
}

mysqli_stmt_bind_param($stmt, 'isssssss', $user, $name, $province, $city, $barangay, $street, $addInfo, $contact);

if (mysqli_stmt_execute($stmt)) {
    header('Location: profile.php?page=addresses');
    exit;
} else {
    echo '<script>alert("An error occurred while adding your address. Please try again later.");</script>';
    header('Location: profile.php?page=addresses');
    exit;
}

mysqli_stmt_close($stmt);
?>
