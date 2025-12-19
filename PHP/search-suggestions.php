<?php
include "../Database/db.php";

// Get the search query from the AJAX request
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare the SQL query to fetch matching results for suggestions
$sql = "SELECT prod_id, prod_name FROM tbl_products WHERE prod_name LIKE ?";
$stmt = $connection->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bind_param('s', $searchTerm);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array for the suggestions
$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = [
        'id' => $row['prod_id'], 
        'name' => $row['prod_name']
    ];
}

$stmt->close();
$connection->close();

// Return the suggestions as JSON
echo json_encode($suggestions);
?>
