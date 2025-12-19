<?php session_start();
include "../Database/db.php";

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['user'];

$sql = "SELECT phone_number FROM tbl_addresses WHERE user_id = $user";
$result = $connection->query($sql);

$contacts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $contacts[] = $row['phone_number'];
    }
}

// Return the addresses as JSON
echo json_encode($contacts);

// Close connection
$connection->close();
?>
