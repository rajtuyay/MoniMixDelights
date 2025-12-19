<?php session_start();
include '../Database/db.php';
// Get data from POST
$user_id = $_SESSION['user'];
$username = $_POST['username'];
$email = $_POST['email'];

// Update query
$query = "UPDATE tbl_user SET username = ?, email = ? WHERE user_id = ?";
$stmt = $connection->prepare($query);

if ($stmt) {
    $stmt->bind_param('ssi', $username, $email, $user_id);

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