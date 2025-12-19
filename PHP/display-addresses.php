<?php session_start();
include "../Database/db.php";

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['user'];

$sql = "SELECT CONCAT(street, ', ', barangay, ', ', city, ', ', province) AS full_address, phone_number FROM tbl_addresses WHERE user_id = $user";
$result = $connection->query($sql);

$addresses = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $addresses[] = $row['full_address'];
    }
}

// Return the addresses as JSON
echo json_encode($addresses);

// Close connection
$connection->close();
?>
