<?php
include '../Database/db.php';
// Get data from POST
$user_id = $_POST['user_id'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$age = $_POST['age'];
$phone = $_POST['contact'];
$gender = $_POST['gender'];
$input_date = $_POST['bday'];

// Check if the date is in the correct format (YYYY-MM-DD)
$date_obj = DateTime::createFromFormat('Y-m-d', $input_date);

if ($date_obj && $date_obj->format('Y-m-d') === $input_date) {
    $bday = $date_obj->format('Y-m-d');  // Already in the correct format
} else {
    echo 'Invalid date format';
    exit;
}

// Update query
$query = "UPDATE tbl_user SET firstname = ?, lastname = ?, age = ?, contact_no = ? , gender = ? , birthday = ? WHERE user_id = ?";
$stmt = $connection->prepare($query);

if ($stmt) {
    $stmt->bind_param('ssisssi', $firstname, $lastname, $age, $phone, $gender, $bday, $user_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
} else {
    echo 'error';
}

$connection->close();
?>